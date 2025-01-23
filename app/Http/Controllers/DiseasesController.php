<?php

namespace App\Http\Controllers;

use App\Models\Diseases;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiseasesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diseases = DB::table('diseases')
            ->get();
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

        $disease->DiseaseName = $request->input('DiseaseName');
        $disease->DiseaseNotes = $request->input('DiseaseNotes');
        $disease->DiseaseMethodOfTreatment = $request->input('DiseaseMethodOfTreatment');
        $disease->save();
        return redirect()->route('diseases.index')->with('success', 'Недуг успешно добавлен.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $disease = Diseases::where('DiseaseID','=',$id)
            ->get();
        return view('diseases.show', compact('disease'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $disease = Diseases::where('DiseaseID','=',$id)
            ->get();
        return view('diseases.edit', compact('disease'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $disease = Diseases::find($id);

        $disease->DiseaseName = $request->input('DiseaseName');
        $disease->DiseaseNotes = $request->input('DiseaseNotes');
        $disease->DiseaseMethodOfTreatment = $request->input('DiseaseMethodOfTreatment');
        $disease->update();
        return redirect()->route('diseases.index')->with('success', 'Недуг успешно изменен.');
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
            ->where('DiseaseID','=', $id)
            ->delete();

        return redirect()->route('diseases.index')->with('success', 'Недуг успешно удален.');
    }
}
