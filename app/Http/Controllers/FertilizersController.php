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
        $fertilizers = DB::table('fertilizers')
            ->get();
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

        $fertilizers->FertilizerName = $request->input('FertilizerName');
        $fertilizers->FertilizerDesc = $request->input('FertilizerDesc');
        $fertilizers->save();

        return redirect()->route('fertilizers.index')->with('success', 'Удобрение успешно добавлено.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $fertilizer = Fertilizers::where('FertilizerID','=',$id)
            ->get();
        return view('fertilizers.show', compact('fertilizer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $fertilizer = Fertilizers::where('FertilizerID','=',$id)
        ->get();
        return view('fertilizers.edit', compact('fertilizer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $fertilizer = Fertilizers::find($id);

        $fertilizer->FertilizerName = $request->input('FertilizerName');
        $fertilizer->FertilizerDesc = $request->input('FertilizerDesc');

        $fertilizer->update();

        return redirect()->route('fertilizers.index')->with('success', 'Удобрение успешно изменено.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $waterings = DB::table('flower_waterings')
            ->where('FertilizerID', '=', $id)
            ->delete();
        $fertilizer = DB::table('fertilizers')
            ->where('FertilizerID', '=', $id)
            ->delete();

        return redirect()->route('fertilizers.index')->with('success', 'Удобрение успешно удалено.');
    }
}
