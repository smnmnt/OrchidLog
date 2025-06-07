<?php

namespace App\Http\Controllers;

use App\Models\Soils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SoilsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $soils = Soils::all();
        return view('soils.index', compact('soils'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('soils.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $soils = new Soils();

        $soils->Name = $request->input('Name');

        $soils->save();

        $id = $soils->ID;
        return redirect()
            ->route('soils.show', compact('id'))
            ->with('success', 'tp.added_soil');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $soil = Soils::where('ID', '=', $id)
            ->get();
        return view('soils.show', compact('soil'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $soil = Soils::where('ID', '=', $id)
            ->get();
        return view('soils.edit', compact('soil'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $soil = Soils::find($id);

        $soil->Name = $request->input('Name');

        $soil->update();

        return redirect()
            ->route('soils.show', compact('id'))
            ->with('success', "tp.edited_soil");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $soil_transplant_link = DB::table('flower_s_t_links')
            ->where('SoilID','=',$id)
            ->delete();
        $soil = DB::table('soils')
            ->where('ID', '=', $id)
            ->delete();
        return redirect()
            ->route('soils.index')
            ->with('warning', 'tp.deleted_soil');

    }
}
