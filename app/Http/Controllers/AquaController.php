<?php

namespace App\Http\Controllers;

use App\Models\AquaTestResults;
use App\Models\AquaTests;
use App\Models\AquaTestTypes;
use App\Models\Aquariums;
use App\Services\Aqua\AquaCalculatedResultsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AquaController extends Controller
{
	public function __construct(
		private readonly AquaCalculatedResultsService $calculatedResults,
	) {
	}

	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$tests = AquaTests::query()
			->with([
				'aquarium',
				'results.type',
			])
			->orderByDesc('tested_at')
			->get();
		$isFishkeeping = true;
		return view('aqua.test.index', compact('tests' , 'isFishkeeping'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$isFishkeeping = true;
		return view('aqua.test.create', [
			'aquariums' => Aquariums::query()->orderBy('name')->get(),
			'types' => $this->editableTypes(),
			'isFishkeeping' => $isFishkeeping,
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$data = $this->validatedData($request);

		$test = DB::transaction(function () use ($data) {
			$test = AquaTests::query()->create([
				'source_type' => $data['source_type'],
				'source_name' => $data['source_type'] === AquaTests::SOURCE_TYPE_TAP
					? $data['source_name']
					: null,
				'aquarium_id' => $data['source_type'] === AquaTests::SOURCE_TYPE_AQUARIUM
					? $data['aquarium_id']
					: null,
				'tested_at' => $data['tested_at'],
				'notes' => $data['notes'] ?? null,
			]);

			$this->syncResults($test, $data['results'] ?? []);
			$this->calculatedResults->sync($test);

			return $test;
		});

		return redirect()
			->route('aqua.test.show', ['id' => $test->id])
			->with('success', 'Тест воды добавлен');
	}

	/**
	 * Display the specified resource.
	 */
	public function show($id)
	{
		$test = AquaTests::query()
			->with([
				'aquarium',
				'results.type',
			])
			->findOrFail($id);

		$isFishkeeping = true;

		return view('aqua.test.show', compact('test', 'isFishkeeping'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit($id)
	{
		$test = AquaTests::query()
			->with('results.type')
			->findOrFail($id);

		$isFishkeeping = true;

		return view('aqua.test.edit', [
			'test' => $test,
			'aquariums' => Aquariums::query()->orderBy('name')->get(),
			'types' => $this->editableTypes(),
			'resultValues' => $test->results->pluck('value', 'type_id'),
			'isFishkeeping' => $isFishkeeping,
		]);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, $id)
	{
		$data = $this->validatedData($request);

		$test = AquaTests::query()->findOrFail($id);

		DB::transaction(function () use ($test, $data) {
			$test->update([
				'source_type' => $data['source_type'],
				'source_name' => $data['source_type'] === AquaTests::SOURCE_TYPE_TAP
					? $data['source_name']
					: null,
				'aquarium_id' => $data['source_type'] === AquaTests::SOURCE_TYPE_AQUARIUM
					? $data['aquarium_id']
					: null,
				'tested_at' => $data['tested_at'],
				'notes' => $data['notes'] ?? null,
			]);

			$this->syncResults($test, $data['results'] ?? []);
			$this->calculatedResults->sync($test);
		});

		return redirect()
			->route('aqua.test.show', ['id' => $test->id])
			->with('success', 'Тест воды обновлен');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy($id)
	{
		AquaTests::query()->findOrFail($id)->delete();

		return redirect()
			->route('aqua.tests')
			->with('warning', 'Тест воды удален');
	}

	private function validatedData(Request $request): array
	{
		return $request->validate([
			'source_type' => [
				'required',
				Rule::in([
					AquaTests::SOURCE_TYPE_AQUARIUM,
					AquaTests::SOURCE_TYPE_TAP,
				]),
			],
			'aquarium_id' => [
				'nullable',
				'required_if:source_type,'.AquaTests::SOURCE_TYPE_AQUARIUM,
				'exists:aquariums,id',
			],
			'source_name' => [
				'nullable',
				'required_if:source_type,'.AquaTests::SOURCE_TYPE_TAP,
				'string',
				'max:255',
			],
			'tested_at' => ['required', 'date'],
			'notes' => ['nullable', 'string'],
			'results' => ['array'],
			'results.*' => ['nullable', 'numeric'],
		]);
	}

	private function syncResults(AquaTests $test, array $results): void
	{
		$allowedTypeIds = AquaTestTypes::query()
			->where('kind', AquaTestTypes::KIND_MEASURED)
			->where('is_user_editable', true)
			->pluck('id')
			->mapWithKeys(fn ($id) => [(int) $id => true]);

		foreach ($results as $typeId => $value) {
			if (! isset($allowedTypeIds[(int) $typeId])) {
				continue;
			}

			if ($value === null || $value === '') {
				AquaTestResults::query()
					->where('test_id', $test->id)
					->where('type_id', $typeId)
					->delete();

				continue;
			}

			AquaTestResults::query()->updateOrCreate(
				[
					'test_id' => $test->id,
					'type_id' => $typeId,
				],
				['value' => $value],
			);
		}
	}

	private function editableTypes()
	{
		return AquaTestTypes::query()
			->where('kind', AquaTestTypes::KIND_MEASURED)
			->where('is_user_editable', true)
			->orderBy('name')
			->get();
	}
}
