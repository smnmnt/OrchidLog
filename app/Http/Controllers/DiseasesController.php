<?php

namespace App\Http\Controllers;

use App\Models\Diseases;
use App\Models\Flower_DiseaseLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiseasesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diseases = Diseases::all();
        return view('diseases.index', compact('diseases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('diseases.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $disease = new Diseases();

        $disease->Name = $request->input('Name');
        $disease->Desc = $request->input('Desc');
        $disease->MOT = $request->input('MOT');
        $disease->save();
        $id = $disease->ID;
        return redirect()
            ->route('diseases.show', compact('id'))
            ->with('success', 'disease.added_d');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $disease = Diseases::where('ID','=',$id)
            ->get();
        return view('diseases.show', compact('disease'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $disease = Diseases::where('ID','=',$id)
            ->get();
        return view('diseases.edit', compact('disease'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $disease = Diseases::find($id);

        $disease->Name = $request->input('Name');
        $disease->Desc = $request->input('Desc');
        $disease->MOT = $request->input('MOT');
        $disease->update();
        return redirect()
            ->route('diseases.show', compact('id'))
            ->with('success', 'disease.edited_d');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $flower_disease_link = DB::table('flower_disease_links')
            ->where('DiseaseID','=', $id)
            ->delete();
        $disease = DB::table('diseases')
            ->where('ID','=', $id)
            ->delete();

        return redirect()
            ->route('diseases.index')
            ->with('warning', 'disease.deleted_d');
    }
}
