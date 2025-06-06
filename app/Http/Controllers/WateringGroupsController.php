<?php

namespace App\Http\Controllers;

use App\Models\Watering_Groups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WateringGroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wg = Watering_Groups::all();
        return view('wg.index', compact('wg'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('wg.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $wg = new Watering_Groups();

        $wg->Name = $request->input('Name');

        $wg->save();
        $id = $wg->ID;
        return redirect()
            ->route('wg.show', compact('id'))
            ->with('success', 'wtr.added_wg');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $wg = Watering_Groups::where('ID', '=', $id)
            ->get();

        return view('wg.show', compact('wg'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $wg = Watering_Groups::where('ID', '=', $id)
            ->get();

        return view('wg.edit', compact('wg'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $wg = Watering_Groups::find($id);

        $wg->Name = $request->input('Name');

        $wg->update();
        return redirect()
            ->route('wg.show', compact('id'))
            ->with('success', 'wtr.edited_wg');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $waterings = DB::table('flower_waterings')
            ->where('GroupID', '=', $id)
            ->update(['GroupID' => null] );

        $wg = DB::table('watering_groups')
            ->where('ID', '=', $id)
            ->delete();

        return redirect()
            ->route('wg.index')
            ->with('warning', 'wtr.deleted_wg');
    }
}
