<?php

namespace App\Http\Controllers;

use App\Models\Fertilizers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FertilizersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fertilizers = Fertilizers::all();
        return view('fertilizers.index', compact('fertilizers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('fertilizers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fertilizers = new Fertilizers();

        $fertilizers->Name = $request->input('Name');
        $fertilizers->Desc = $request->input('Desc');
        $fertilizers->save();

        $id = $fertilizers->ID;

        return redirect()
            ->route('fertilizers.show', compact('id'))
            ->with('success', 'fert.added_d');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $fertilizer = Fertilizers::where('ID','=',$id)
            ->get();

        $waterings = DB::table('flower_waterings')
            ->leftJoin('watering_types_of', 'flower_waterings.TypeID', '=', 'watering_types_of.ID')
            ->leftJoin('fertilizers', 'flower_waterings.FertilizerID', '=', 'fertilizers.ID')
            ->leftJoin('watering_groups', 'flower_waterings.GroupID', '=', 'watering_groups.ID')
            ->leftJoin('flower_watering_links', 'flower_waterings.ID', '=', 'flower_watering_links.WateringID')
            ->where('flower_waterings.FertilizerID','=',$id)

            ->select(
                'flower_waterings.*',
                'watering_types_of.WateringName',
                'watering_types_of.TypeOfImg',
                'fertilizers.Name as FertilizerName',
                'watering_groups.Name as GroupName',
                DB::raw('COUNT(flower_watering_links.FlowerID) as FlowerCount')
            )
            ->groupBy('flower_waterings.ID')
            ->orderByDesc('WateringDate')
            ->orderByDesc('updated_at')
            ->get();

        return view('fertilizers.show', compact('fertilizer', 'waterings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $fertilizer = Fertilizers::where('ID','=',$id)
        ->get();
        return view('fertilizers.edit', compact('fertilizer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $fertilizer = Fertilizers::find($id);

        $fertilizer->Name = $request->input('Name');
        $fertilizer->Desc = $request->input('Desc');

        $fertilizer->update();

        return redirect()
            ->route('fertilizers.show', compact('id'))
            ->with('success', 'fert.edited_d');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $waterings = DB::table('flower_waterings')
            ->join('flower_watering_links', 'flower_waterings.ID', '=', 'flower_watering_links.ID')
            ->where('FertilizerID', '=', $id)
            ->delete();
        $fertilizer = DB::table('fertilizers')
            ->where('ID', '=', $id)
            ->delete();

        return redirect()
            ->route('fertilizers.index')
            ->with('warning', 'fert.deleted_d');
    }
}
