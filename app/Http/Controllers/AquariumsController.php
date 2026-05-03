<?php

namespace App\Http\Controllers;

use App\Models\Aquariums;
use Illuminate\Http\Request;

class AquariumsController extends Controller
{
	public function index()
	{
		$aquariums = Aquariums::query()
			->withCount('tests')
			->orderBy('name')
			->get();

		$isFishkeeping = true;
		return view('aqua.aquarium.index', compact('aquariums', 'isFishkeeping'));
	}

	public function create()
	{
		$isFishkeeping = true;
		return view('aqua.aquarium.create', compact('isFishkeeping'));
	}

	public function store(Request $request)
	{
		$aquarium = Aquariums::query()->create($this->validatedData($request));

		return redirect()
			->route('aqua.aquariums')
			->with('success', "Аквариум {$aquarium->name} добавлен");
	}

	public function edit($id)
	{
		$aquarium = Aquariums::query()->findOrFail($id);
		$isFishkeeping = true;

		return view('aqua.aquarium.edit', compact('aquarium', 'isFishkeeping'));
	}

	public function update(Request $request, $id)
	{
		$aquarium = Aquariums::query()->findOrFail($id);
		$aquarium->update($this->validatedData($request));

		return redirect()
			->route('aqua.aquariums')
			->with('success', "Аквариум {$aquarium->name} обновлен");
	}

	public function destroy($id)
	{
		$aquarium = Aquariums::query()->withCount('tests')->findOrFail($id);

		if ($aquarium->tests_count > 0) {
			return redirect()
				->route('aqua.aquariums')
				->with('warning', 'Нельзя удалить аквариум, у которого есть тесты');
		}

		$aquarium->delete();

		return redirect()
			->route('aqua.aquariums')
			->with('warning', 'Аквариум удален');
	}

	private function validatedData(Request $request): array
	{
		return $request->validate([
			'name' => ['required', 'string', 'max:255'],
			'volume' => ['nullable', 'integer', 'min:0'],
			'description' => ['nullable', 'string'],
		]);
	}
}
