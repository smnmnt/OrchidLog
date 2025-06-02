<?php

namespace App\Http\Controllers;

use App\Models\Watering_Types_Of;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WateringTypesOfController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tow = Watering_Types_Of::all();
        return view('tow.index', compact('tow'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tow.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tow = new Watering_Types_Of();

        $tow->WateringName = $request->input('Name');
        $nameWithoutSpaces = str_replace(array(' ', '?', '!'), '', $tow->Name);
        if ($files = $request->file('Images')) {
            foreach ($files as $file) {
                $name = time().'.'.$file->extension();
                $path = 'storage/wot/' . $nameWithoutSpaces . '/';
                $url = '/'.$file->move($path, $name);
                $tow->TypeOfImg = $url;
            }
        }
        $tow->save();
        return redirect()
            ->route('tow.index')
            ->with('success', 'Тип обработки успешно добавлен');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tow = Watering_Types_Of::where('ID', '=', $id)
            ->get();

        return view('tow.show', compact('tow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tow = Watering_Types_Of::where('ID', '=', $id)
            ->get();

        return view('tow.edit', compact('tow'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tow = Watering_Types_Of::find($id);

        $tow->WateringName = $request->input('Name');

        $nameWithoutSpaces = str_replace(array(' ', '?', '!'), '', $tow->Name);
        if ($files = $request->file('Images')) {
            foreach ($files as $file) {
                $name = time().'.'.$file->extension();
                $path = 'storage/wot/' . $nameWithoutSpaces . '/';
                $url = '/'.$file->move($path, $name);
                $tow->TypeOfImg = $url;
            }
        }
        $tow->update();
        return redirect()
            ->route('tow.index')
            ->with('success', 'Место успешно изменено');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $waterings = DB::table('flower_waterings')
            ->join('flower_watering_links', 'flower_waterings.ID', '=', 'flower_watering_links.ID')
            ->where('TypeID', '=', $id)
            ->delete();

        $tow = DB::table('watering_types_of')
            ->where('ID', '=', $id)
            ->delete();

        return redirect()
            ->route('tow.index')
            ->with('warning', 'Место успешно удалено.');
    }
}
