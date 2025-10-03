<?php

namespace App\Http\Controllers;

use App\Models\Placements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlacementsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $placements = Placements::all();
        return view('placements.index', compact('placements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('placements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $placement = new Placements();

        $placement->Name = $request->input('Name');

        $placement->save();
        $id = $placement->ID;
        return redirect()
            ->route('placements.show', compact('id'))
            ->with('success', 'flower.added_plc');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $placement = Placements::where('ID', '=', $id)
        ->get();
        $flowers = DB::table('flowers')
			->where('flowers.archived','=',0)
            ->join('flower_placement_links', 'flowers.ID', '=', 'flower_placement_links.FlowerID')
            ->where('flower_placement_links.PlacementID', '=', $id)
            ->get();

        return view('placements.show', compact('placement', 'flowers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $placement = Placements::where('ID', '=', $id)
            ->get();

        return view('placements.edit', compact('placement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $placement = Placements::find($id);

        $placement->Name = $request->input('Name');

        $placement->update();
        return redirect()
            ->route('placements.show', compact('id'))
            ->with('success', 'flower.edited_plc');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $placement_link = DB::table('flower_placement_links')
            ->where('PlacementID', '=', $id)
            ->delete();
        $placement = DB::table('placements')
            ->where('ID', '=', $id)
            ->delete();

        return redirect()
            ->route('placements.index')
            ->with('warning', 'flower.deleted_plc');




    }
}
