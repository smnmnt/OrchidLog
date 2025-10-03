<?php

namespace App\Http\Controllers;

use App\Models\Types_of_Planting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TypesOfPlantingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $top = Types_of_Planting::all();
        return view('top.index', compact('top'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('top.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $top = new Types_of_Planting();

        $top->Name = $request->input('Name');

        $top->save();

        $id = $top->ID;
        return redirect()
            ->route('top.show', compact('id'))
            ->with('success', 'tp.added_top');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $top = Types_of_Planting::where('ID', '=', $id)
            ->get();

        $tps = DB::table('flower_transplantings')
            ->leftjoin('flower_s_t_links', 'flower_s_t_links.TPID', '=', 'flower_transplantings.ID')
            ->leftjoin('soils', 'soils.ID', '=', 'flower_s_t_links.SoilID')
            ->leftjoin('flowers', 'flowers.ID', '=', 'flower_transplantings.FlowerID')
			->where('flowers.archived','=',0)
            ->leftjoin('types_of_planting', 'flower_transplantings.TOPID', '=', 'types_of_planting.ID')
            ->select(
                'flower_transplantings.*',
                'flowers.Name',
                'types_of_planting.Name as TypeName',
                'flower_transplantings.DOT',
                'flower_transplantings.SOP',
            )
            ->where('types_of_planting.ID', '=', $id)
            ->groupBy('flower_transplantings.ID')
            ->get();

        return view('top.show', compact('top', 'tps'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $top = Types_of_Planting::where('ID', '=', $id)
            ->get();

        return view('top.edit', compact('top'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $top = Types_of_Planting::find($id);

        $top->Name = $request->input('Name');

        $top->update();
        return redirect()
            ->route('top.show', compact('id'))
            ->with('success', 'tp.edited_top');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $transplant = DB::table('flower_transplantings')
            ->where('TOPID', '=', $id)
            ->update(['TOPID' => null] );

        $top = DB::table('types_of_planting')
            ->where('ID', '=', $id)
            ->delete();

        return redirect()
            ->route('top.index')
            ->with('warning', 'tp.deleted_top');
    }
}
