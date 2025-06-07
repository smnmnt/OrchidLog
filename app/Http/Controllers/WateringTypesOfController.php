<?php

namespace App\Http\Controllers;

use App\Models\Watering_Types_Of;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WateringTypesOfController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tow = Watering_Types_Of::all();
        return view('tow.index', compact('tow'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tow.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tow = new Watering_Types_Of();

        $tow->WateringName  = $request->input('Name');
        $tow->TypeOfImg     = $request->input('Icon');

        $tow->save();
        $id = $tow->ID;
        return redirect()
            ->route('tow.show', compact('id'))
            ->with('success', 'wtr.added_type');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tow = Watering_Types_Of::where('ID', '=', $id)
            ->get();


        $waterings = DB::table('flower_waterings')
            ->leftJoin('watering_types_of', 'flower_waterings.TypeID', '=', 'watering_types_of.ID')
            ->leftJoin('fertilizers', 'flower_waterings.FertilizerID', '=', 'fertilizers.ID')
            ->leftJoin('watering_groups', 'flower_waterings.GroupID', '=', 'watering_groups.ID')
            ->leftJoin('flower_watering_links', 'flower_waterings.ID', '=', 'flower_watering_links.WateringID')
            ->where('flower_waterings.TypeID','=',$id)

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

        return view('tow.show', compact('tow', 'waterings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tow = Watering_Types_Of::where('ID', '=', $id)
            ->get();

        return view('tow.edit', compact('tow'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tow = Watering_Types_Of::find($id);

        $tow->WateringName  = $request->input('Name');
        $tow->TypeOfImg     = $request->input('Icon');

        $tow->update();
        return redirect()
            ->route('tow.show', compact('id'))
            ->with('success', 'wtr.edited_type');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $waterings = DB::table('flower_waterings')
            ->where('TypeID', '=', $id)
            ->update(['TypeID' => null] );

        $tow = DB::table('watering_types_of')
            ->where('ID', '=', $id)
            ->delete();

        return redirect()
            ->route('tow.index')
            ->with('warning', 'wtr.deleted_type');
    }
}
