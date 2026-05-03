<?php

namespace App\Http\Controllers;

use App\Models\AquaTestTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AquaTestTypesController extends Controller
{
	public function index()
	{
		$types = AquaTestTypes::query()
			->withCount('results')
			->orderBy('name')
			->get();

		$isFishkeeping = true;
		return view('aqua.type.index', compact('types', 'isFishkeeping'));
	}

	public function create()
	{
		$isFishkeeping = true;
		return view('aqua.type.create', compact('isFishkeeping'));
	}

	public function store(Request $request)
	{
		$data = $this->validatedData($request);

		$type = AquaTestTypes::query()->create([
			...$data,
			'code' => $this->makeCode($data['name']),
			'kind' => AquaTestTypes::KIND_MEASURED,
			'calculator' => null,
			'is_user_editable' => true,
		]);

		return redirect()
			->route('aqua.types')
			->with('success', "Тип теста {$type->name} добавлен");
	}

	public function edit($id)
	{
		$type = AquaTestTypes::query()->findOrFail($id);
		$isFishkeeping = true;

		return view('aqua.type.edit', compact('type', 'isFishkeeping'));
	}

	public function update(Request $request, $id)
	{
		$type = AquaTestTypes::query()->findOrFail($id);
		$data = $this->validatedData($request);

		$type->update([
			...$data,
			'kind' => $type->kind,
			'calculator' => $type->calculator,
			'is_user_editable' => $type->is_user_editable,
		]);

		return redirect()
			->route('aqua.types')
			->with('success', "Тип теста {$type->name} обновлен");
	}

	public function destroy($id)
	{
		$type = AquaTestTypes::query()->withCount('results')->findOrFail($id);

		if ($type->results_count > 0) {
			return redirect()
				->route('aqua.types')
				->with('warning', 'Нельзя удалить тип теста, у которого есть результаты');
		}

		$type->delete();

		return redirect()
			->route('aqua.types')
			->with('warning', 'Тип теста удален');
	}

	private function validatedData(Request $request): array
	{
		return $request->validate([
			'name' => ['required', 'string', 'max:255'],
			'unit' => ['nullable', 'string', 'max:255'],
			'value_min' => ['nullable', 'numeric'],
			'value_max' => ['nullable', 'numeric', 'gte:value_min'],
			'description' => ['nullable', 'string'],
		]);
	}

	private function makeCode(string $name): string
	{
		$baseCode = Str::slug($name, '_') ?: 'test_type';
		$code = $baseCode;
		$counter = 2;

		while (AquaTestTypes::query()->where('code', $code)->exists()) {
			$code = "{$baseCode}_{$counter}";
			$counter++;
		}

		return $code;
	}
}
