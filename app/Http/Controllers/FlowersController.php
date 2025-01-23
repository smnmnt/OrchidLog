<?php

namespace App\Http\Controllers;

use App\Models\Flowers;
use App\Models\Fertilizers;
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
        $fertilizers = DB::table('fertilizers')
            ->get();
        return view('main', compact('fertilizers'));
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
        return view('lists.index', compact('fertilizers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Flowers $flowers)
    {
        //
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
