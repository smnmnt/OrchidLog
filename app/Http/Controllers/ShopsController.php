<?php

namespace App\Http\Controllers;

use App\Models\Shops;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shops = Shops::all();
        return view('shops.index', compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('shops.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $shop = new Shops();

        $shop->Name = $request->input('Name');
        $shop->Link = $request->input('Link');

        $shop->save();

        $id = $shop->ID;
        return redirect()
            ->route('shops.show', compact("id"))
            ->with('success', 'flower.added_shop');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $shop = Shops::where('ID', '=', $id)
            ->get();

        return view('shops.show', compact('shop'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $shop = Shops::where('ID', '=', $id)
            ->get();

        return view('shops.edit', compact('shop'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $shop = Shops::find($id);

        $shop->Name = $request->input('Name');
        $shop->Link = $request->input('Link');

        $shop->update();
        return redirect()
            ->route('shops.show', compact($id))
            ->with('success', 'flower.edited_shop');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $shop_link = DB::table('flower_shop_links')
            ->where('ShopID', '=', $id)
            ->delete();
        $shop = DB::table('shops')
            ->where('ID', '=', $id)
            ->delete();

        return redirect()
            ->route('shops.index')
            ->with('warning', 'flower.deleted_shop');




    }
}
