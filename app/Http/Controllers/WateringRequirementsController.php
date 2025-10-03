<?php

namespace App\Http\Controllers;

use App\Models\Watering_Requirements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WateringRequirementsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $watering_requirements = Watering_Requirements::all();
        return view('watering_reqs.index', compact('watering_requirements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('watering_reqs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $watering_requirement = new Watering_Requirements();

        $watering_requirement->Name = $request->input('Name');

        $watering_requirement->save();
        $id = $watering_requirement->ID;
        return redirect()
            ->route('watering_reqs.show', compact('id'))
            ->with('success', 'wtr.added_wr');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $watering_requirement = Watering_Requirements::where('ID', '=', $id)
            ->get();
        $flowers = DB::table('flowers')
			->where('flowers.archived','=',0)
            ->join('flower_w_r_links', 'flower_w_r_links.FlowerID', '=', 'flowers.ID')
            ->where('flower_w_r_links.WRID', '=', $id)
            ->get();

        return view('watering_reqs.show', compact('watering_requirement', 'flowers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $watering_requirement = Watering_Requirements::where('ID', '=', $id)
            ->get();

        return view('watering_reqs.edit', compact('watering_requirement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $watering_requirement = Watering_Requirements::find($id);

        $watering_requirement->Name = $request->input('Name');

        $watering_requirement->update();
        return redirect()
            ->route('watering_reqs.show', compact('id'))
            ->with('success', 'wtr.edited_wr');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $watering_requirement_link = DB::table('flower_w_r_links')
            ->where('WRID', '=', $id)
            ->delete();

        $watering_requirement = DB::table('watering_requirements')
            ->where('ID', '=', $id)
            ->delete();

        return redirect()
            ->route('watering_reqs.index')
            ->with('warning', 'wtr.deleted_wr');
    }
}
