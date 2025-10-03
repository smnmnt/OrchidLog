<?php

namespace App\Http\Controllers;

use App\Models\Flower_Waterings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FlowerWateringsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // реализованно в fc
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
		try {
			// 1. Создаем и сохраняем новую запись
			$watering = new Flower_Waterings();
			$watering->WateringDate = now();
			$watering->save();

			// 2. Проверяем, что запись сохранена и имеет ID
			if (!$watering->ID) {
				throw new \Exception('Не удалось получить ID созданной записи');
			}

			// 3. Перенаправляем на редактирование
			return redirect()->route('global_watering.edit', ['id' => $watering->ID]);

		} catch (\Exception $e) {
			// 4. Обработка ошибок
			return back()->with('error', 'Ошибка: ' . $e->getMessage());
		}
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'WateringDate' => 'required|date',
            'TypeID' => 'required|integer|exists:watering_types_of,ID',
			'FertilizerID' => 'nullable|array',
			'FertilizerID.*' => 'integer|exists:fertilizers,ID',
            'FertilizerDoze' => 'nullable|string',
            'GroupID' => 'nullable|integer|exists:watering_groups,ID',
        ]);

        $watering = new Flower_Waterings();
        $watering->TypeID = $request->input('TypeID');
        $watering->WateringDate = $request->input('WateringDate');
		$watering->FertilizerID = json_encode($request->input('FertilizerID', []));
        $watering->FertilizerDoze = $request->input('FertilizerDoze');
        $watering->GroupID = $request->input('GroupID');
        $watering->save();

        $watering_id = $watering->ID;

        if (!$request->filled('GroupID')) {
            $flowers = \DB::table('flowers')->pluck('ID');
            foreach ($flowers as $flower_id) {
                \DB::table('flower_watering_links')->insert([
                    'FlowerID' => $flower_id,
                    'WateringID' => $watering_id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                }
        }

        return redirect()
            ->route('global_watering.show', ['id' => $watering_id] )
            ->with('success', 'wtr.added_d');
    }

    /**
     * Display the specified resource.
     */
	public function show($id)
	{
		// Забираем сам полив
		$watering = DB::table('flower_waterings')
			->leftJoin('watering_types_of', 'flower_waterings.TypeID', '=', 'watering_types_of.ID')
			->leftJoin('watering_groups', 'flower_waterings.GroupID', '=', 'watering_groups.ID')
			->where('flower_waterings.ID', '=', $id)
			->select(
				'flower_waterings.*',
				'watering_types_of.WateringName',
				'watering_types_of.TypeOfImg',
				'watering_groups.Name as GroupName'
			)
			->first();

		if (!$watering) {
			abort(404);
		}

		// Загружаем связанные цветы
		$flowers = DB::table('flowers')
			->where('flowers.archived','=',0)
			->select('flowers.ID', 'flowers.Name')
			->join('flower_watering_links', 'flowers.ID', '=', 'flower_watering_links.FlowerID')
			->where('flower_watering_links.WateringID', '=', $id)
			->groupBy('flowers.ID', 'flowers.Name')
			->get();

		// Загружаем все удобрения
		$fertilizers = DB::table('fertilizers')->pluck('Name', 'ID');

		// Преобразуем JSON-удобрения в названия
		$fertilizerIDs = json_decode($watering->FertilizerID ?? '[]', true);
		$fertilizerNames = collect($fertilizerIDs)
			->map(fn($id) => $fertilizers[$id] ?? null)
			->filter()
			->values();
		$type = DB::table('watering_types_of')
			->where('ID', '=', $watering->TypeID)
			->get();

		return view('global_watering_show', [
			'watering' => $watering,
			'flowers' => $flowers,
			'type' => $type,
			'fertilizerNames' => $fertilizerNames,
		]);
	}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $watering = DB::table('flower_waterings')->where('ID', $id)->first();
        $types = DB::table('watering_types_of')->get();
        $groups = DB::table('watering_groups')->get();
		$placements = DB::table('placements')->orderBy('Name')->get();

		$flowerPlacements = DB::table('flower_placement_links')
			->join('placements', 'flower_placement_links.PlacementID', '=', 'placements.ID')
			->pluck('placements.Name', 'flower_placement_links.FlowerID')
			->toArray();

		$rawFertIDs = json_decode($watering->FertilizerID ?? '[]', true);

// Защита от одного числа или null
		$selectedFertIDs = is_array($rawFertIDs) ? $rawFertIDs : [$rawFertIDs];

// Если есть выбранные удобрения — сортируем по порядку
		if (!empty($selectedFertIDs) && is_array($selectedFertIDs)) {
			$fertilizers = DB::table('fertilizers')
				->orderByRaw('FIELD(ID, ' . implode(',', $selectedFertIDs) . ')')
				->get();
		} else {
			// Иначе просто по алфавиту
			$fertilizers = DB::table('fertilizers')
				->orderBy('Name')
				->get();
		}

        //$allFlowers = DB::table('flowers')->orderBy('Name')->get();
        $query = DB::table('flowers')
			->where('flowers.archived','=',0)
			->orderBy('Name');

        $allFlowers = $query->get();

        // Для каждого цветка определяем статус
        foreach ($allFlowers as $flower) {
            // Цветущий = есть запись в flower_blooms с этим FlowerID и BE == null
            $flower->isBlooming = DB::table('flower_blooms')
                ->where('FlowerID', $flower->ID)
                ->whereNull('BE')
                ->exists();

            // Больной = есть запись в flower_disease_links
            $flower->isSick = DB::table('flower_disease_links')
                ->where('FlowerID', $flower->ID)
                ->exists();

			$flower->wateringDates = DB::table('flower_watering_links')
				->join('flower_waterings', 'flower_waterings.ID', '=', 'flower_watering_links.WateringID')
				->where('flower_watering_links.FlowerID', $flower->ID)
				->pluck('flower_waterings.WateringDate')
				->map(fn($date) => \Carbon\Carbon::parse($date)->format('Y-m-d'))
				->toArray();
        }

        $selectedFlowerIds = DB::table('flower_watering_links')
            ->where('WateringID', $id)
            ->pluck('FlowerID')
            ->toArray();

        return view('global_watering_edit', compact(
            'watering', 'types', 'fertilizers', 'groups', 'allFlowers', 'selectedFlowerIds', 'placements', 'flowerPlacements'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'WateringDate' => 'required|date',
            'TypeID' => 'required|integer|exists:watering_types_of,ID',
            'FertilizerID' => 'nullable|array',
            'FertilizerID.*' => 'integer|exists:fertilizers,ID',
            'FertilizerDoze' => 'nullable|string',
            'flowers' => 'nullable|array',
            'flowers.*' => 'integer|exists:flowers,ID'
        ]);

        DB::table('flower_waterings')->where('ID', $id)->update([
            'WateringDate' => $request->input('WateringDate'),
            'TypeID' => $request->input('TypeID'),
            'FertilizerID' => json_encode($request->input('FertilizerID', [])),
            'FertilizerDoze' => $request->input('FertilizerDoze'),
            'updated_at' => now()
        ]);

        DB::table('flower_watering_links')->where('WateringID', $id)->delete();

        if ($request->filled('flowers')) {
            foreach ($request->input('flowers') as $flower_id) {
                DB::table('flower_watering_links')->insert([
                    'FlowerID' => $flower_id,
                    'WateringID' => $id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

//        return redirect()->route('watering.index')->with('success', 'wtr.edited_d');

        return redirect()
            ->route('global_watering.show', compact('id'))
            ->with('success', 'wtr.edited_d');
    }

    /**
     * Remove the specified resource from storage.
     */
    // Удаление глобального полива
    public function destroy($id)
    {
        DB::table('flower_watering_links')->where('WateringID', $id)->delete();
        DB::table('flower_waterings')->where('ID', $id)->delete();

        return redirect()->route('watering.index')->with('warning', 'wtr.deleted_d');
    }


    /**
     * Remove the specified resource from storage.
     */
    // Удаление связи с глобальным поливом
    public function destroy_link($WateringID, $id)
    {
        DB::table('flower_watering_links')
            ->where('WateringID', $WateringID)
            ->where('FlowerID', $id)
            ->delete();

        return redirect()
            ->route('flowers.show', compact('id'))
            ->with('success', "wtr.deleted_link");
    }
}
