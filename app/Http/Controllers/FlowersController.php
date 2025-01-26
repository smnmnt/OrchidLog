<?php

namespace App\Http\Controllers;

use App\Models\Flowers;
use App\Models\Fertilizers;
use App\Models\Placements;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class FlowersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function main(): View|Factory|Application
    {
        return view('main');
    }

    /**
     * Display main page.
     */
    public function index()
    {
        $flowers = DB::table('flowers')
            ->get();
        $fertilizers = DB::table('fertilizers')
            ->get();
        $soils = DB::table('soils')
            ->get();
        $diseases = DB::table('diseases')
            ->get();
        $placements = DB::table('placements')
            ->get();

        return view('lists.index', compact('fertilizers','soils','diseases', 'placements'));
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

        $placement->PlacementName = $request->input('Name');

        $placement->save();
        return redirect()
            ->route('placements.index')
            ->with('success', 'Место успешно добавлено');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $flowers = DB::table('flowers')
            ->join('flower_images', 'flower_images.FlowerID', '=', 'flowers.ID')
            ->join('blooms','blooms.FlowerID','=','flowers.ID')
            ->join('transplantings','transplantings.FlowerID','=','flowers.ID')
            ->join('flower_s_t_links','flower_s_t_links.TPID','=','transplantings.ID')
            ->join('waterings','waterings.FlowerID','=','flowers.ID')
            ->join('flower_disease_links', 'flower_disease_links.FlowerID', '=', 'flowers.ID')
            ->where('PlacementID', '=', $id)
            ->get();

        return view('flowers.show', compact('flowers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Flowers $flowers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Flowers $flowers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flowers $flowers)
    {
        //
    }
}
