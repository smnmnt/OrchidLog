<?php

namespace App\Http\Controllers;

use App\Models\Fertilizers;
use App\Models\Flower_Blooms;
use App\Models\Flower_DiseaseLink;
use App\Models\Flower_Images;
use App\Models\Flower_Placement_Links;
use App\Models\Flower_Shop_Links;
use App\Models\Flower_ST_Links;
use App\Models\Flower_Transplantings;
use App\Models\Flower_Watering_Links;
use App\Models\Flower_Waterings;
use App\Models\Flower_WR_Links;
use App\Models\Flowers;
use App\Models\Placements;
use App\Models\Shops;
use App\Models\Soils;
use App\Models\Types_of_Planting;
use App\Models\Watering_Requirements;
use App\Models\Watering_Types_Of;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use function Laravel\Prompts\table;


class FlowersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function main()
    {
    	$flower = DB::table('flowers')
    		->join('flower_images', 'flowers.ID', '=', 'flower_images.FlowerID')
    		->where('flower_images.IsMain', true)
    		->inRandomOrder()
    		->select('flowers.*', 'flower_images.Link as ImageLink')
    		->first();

        return view('main', compact('flower'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $flowers = DB::table('flowers')
            ->where('Name', 'like', "%$query%")
            ->orWhere('Notes', 'like', "%$query%")
            ->get();

        return view('flowers.index', compact('flowers'));
    }

    /**
     * Display a listing of the resource.
     */
    public function watering_index()
    {
        $waterings = DB::table('flower_waterings')
            ->leftJoin('watering_types_of', 'flower_waterings.TypeID', '=', 'watering_types_of.ID')
            ->leftJoin('fertilizers', 'flower_waterings.FertilizerID', '=', 'fertilizers.ID')
            ->leftJoin('watering_groups', 'flower_waterings.GroupID', '=', 'watering_groups.ID')
            ->leftJoin('flower_watering_links', 'flower_waterings.ID', '=', 'flower_watering_links.WateringID')
            ->select(
                'flower_waterings.*',
                'watering_types_of.WateringName',
                'watering_types_of.TypeOfImg',
                'fertilizers.Name as FertilizerName',
                'watering_groups.Name as GroupName',
                DB::raw('COUNT(flower_watering_links.FlowerID) as FlowerCount')
            )
            ->groupBy('flower_waterings.ID')
            ->orderByDesc('WateringDate')
            ->orderByDesc('updated_at')
            ->get();

        return view('watering_index', compact('waterings'));
    }
    /**
     * Display main page.
     */
    public function index()
    {
        $flowers = DB::table('flowers')
        	->leftJoin('flower_blooms', 'flower_blooms.FlowerID','=', 'flowers.ID')
        	->select('flowers.*', DB::raw('MAX(flower_blooms.updated_at) as LastBloom'))
        	->groupBy('flowers.ID')
        	->orderByRaw('LastBloom IS NOT NUll, LastBloom ASC')
            ->get();
        $fertilizers = DB::table('fertilizers')
            ->get();
        $soils = DB::table('soils')
            ->get();
        $diseases = DB::table('diseases')
            ->get();
        $placements = DB::table('placements')
            ->get();
        $shops = DB::table('shops')
            ->get();
        $watering_reqs = DB::table('watering_requirements')
            ->get();
        $top = DB::table('types_of_planting')
            ->get();
        $tow = DB::table('watering_types_of')
            ->get();
        $wg = DB::table('watering_groups')
            ->get();
        return view('flowers.index',
            compact('fertilizers',
                'soils',
                'diseases',
                'placements',
                'shops',
                'watering_reqs',
                'top',
                'tow',
                'wg',
                'flowers'
            ));
    }

    public function list()
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
        $shops = DB::table('shops')
            ->get();
        $watering_reqs = DB::table('watering_requirements')
            ->get();
        $top = DB::table('types_of_planting')
            ->get();
        $tow = DB::table('watering_types_of')
            ->get();
        $wg = DB::table('watering_groups')
            ->get();
        return view('lists.index',
            compact('fertilizers',
                'soils',
                'diseases',
                'placements',
                'shops',
                'watering_reqs',
                'top',
                'tow',
                'wg',
                'flowers'
            ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $shops = DB::table('shops')
            ->get();
        $wrs = DB::table('watering_requirements')
            ->get();
        $placements = DB::table('placements')
            ->get();
        return view('flowers.create', compact('shops', 'wrs', 'placements'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create_blooms($id)
    {
        $flower = DB::table('flowers')
            ->where('ID','=', $id)
            ->first();
        return view('flowers.parts.bloom_create', compact('flower'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_waterings($id)
    {
        $flower = DB::table('flowers')
            ->where('ID','=', $id)
            ->first();
        $types = DB::table('watering_types_of')
            ->get();
        $fertilizers = DB::table('fertilizers')
            ->get();

        return view('flowers.parts.watering_create', compact('flower', 'types', 'fertilizers'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create_transplantings($id)
    {
        $flower = DB::table('flowers')
            ->where('ID','=', $id)
            ->first();
        $types = DB::table('types_of_planting')
            ->get();
        $soils = DB::table('soils')
            ->get();

        return view('flowers.parts.transplanting_create', compact('flower', 'types', 'soils'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create_diseases($id)
    {
        $flower = DB::table('flowers')
            ->where('ID','=', $id)
            ->first();
        $types = DB::table('diseases')
            ->get();

        return view('flowers.parts.disease_create', compact('flower', 'types'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $flower = new Flowers();
        $shop_link = new Flower_Shop_Links();
        $watering_req_link = new Flower_WR_Links();
        $placement_link = new Flower_Placement_Links();


        $flower->Name = $request->input('Name');
        $flower->DOB = $request->input('DOB');
        $flower->Size = $request->input('Size');
        $flower->Notes = $request->input('Notes');

        $flower_name = $flower->Name;
        $nameWithoutSpaces = str_replace(array(' ', '?', '!'), '', $flower_name);

        $flower->save();
        $id = $flower->ID;

        if ($files = $request->file('Images')) {
            foreach ($files as $file) {
                $flower_images = new Flower_Images();

                $flower_images->isMain = true;

                $name = $file->getFilename();
                $path = 'storage/flowers/' . $nameWithoutSpaces . $id . '/';
                $url = $file->move($path, $name . '.webp');

                $flower_images->FlowerID = $id;
                $flower_images->Link = '/' . $url;

                $flower_images->save();
            }
        }

//        placements validation check
        if (!empty($shop_link)) {
            if ($request->input('ShopID')) {
                if ($request->input('ShopID') != $shop_link->ShopID) {
                    $shop_link->delete();
                    $shop_link = new Flower_Shop_Links();
                    $shop_link->FlowerID = $id;
                    $shop_link->ShopID = $request->input('ShopID');
                    $shop_link->save();
                }
            } else {
                $shop_link->delete();
            }
        } else {
            if ($request->input('ShopID')) {
                $shop_link = new Flower_Shop_Links();
                $shop_link->FlowerID = $id;
                $shop_link->ShopID = $request->input('ShopID');
                $shop_link->save();
            }
        }
//        placements validation check
        if (!empty($watering_req_link)) {
            if ($request->input('WRID')) {
                if ($request->input('WRID') != $watering_req_link->WRID) {
                    $watering_req_link->delete();
                    $watering_req_link = new Flower_WR_Links();
                    $watering_req_link->FlowerID = $id;
                    $watering_req_link->WRID = $request->input('WRID');
                    $watering_req_link->save();
                }
            } else {
                $watering_req_link->delete();
            }
        } else {
            if ($request->input('WRID')) {
                $watering_req_link = new Flower_WR_Links();
                $watering_req_link->FlowerID = $id;
                $watering_req_link->WRID = $request->input('WRID');
                $watering_req_link->save();
            }
        }
//        placements validation check
        if (!empty($placement_link)) {
            if ($request->input('PlacementID')) {
                if ($request->input('PlacementID') != $placement_link->PlacementID) {
                    $placement_link->delete();
                    $placement_link = new Flower_Placement_Links();
                    $placement_link->FlowerID = $id;
                    $placement_link->PlacementID = $request->input('PlacementID');
                    $placement_link->save();
                }
            } else {
                $placement_link->delete();
            }
        } else {
            if ($request->input('PlacementID')) {
                $placement_link = new Flower_Placement_Links();
                $placement_link->FlowerID = $id;
                $placement_link->PlacementID = $request->input('PlacementID');
                $placement_link->save();
            }
        }

        return redirect()
            ->route('flowers.show', compact('id'))
            ->with('success', "flower.added_d");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_img(Request $request, $id)
    {
        $flower = DB::table('flowers')
            ->where('ID', '=', $id)
            ->first();
        $flower_name = $flower->Name;
        $allFlowerImages = Flower_Images::where('FlowerID', '=', $id)
            ->get();
        $nameWithoutSpaces = str_replace(array(' ', '?', '!'), '', $flower_name);
        if ($files = $request->file('Images')) {
            foreach ($files as $file) {
                $flower_images = new Flower_Images();

                $name = $file->getFilename();
                $path = 'storage/flowers/' . $nameWithoutSpaces . $id . '/';
                $url = $file->move($path, $name . '.webp');

                $flower_images->FlowerID = $id;
                $flower_images->Link = '/' . $url;
                if (!sizeof($allFlowerImages)) {
                    $flower_images->IsMain = true;
                }
                $flower_images->save();
            }
        }

        return redirect()
            ->route('flowers.show', compact('id'))
            ->with('success', "flower.added_img");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_blooms(Request $request, $id)
    {
        $bloom = new Flower_Blooms();

        $bloom->FlowerID = $id;
        $bloom->BB = $request->input('BB');
        $bloom->BE = $request->input('BE');

        $bloom->save();

        return redirect()
            ->route('flowers.show', compact('id'))
            ->with('success', "bloom.added_d");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_waterings(Request $request, $id)
    {
        $watering = new Flower_Waterings();

        $watering->TypeID = $request->input('TypeID');
        $watering->WateringDate = $request->input('WateringDate');
        if ($request->input('FertilizerID')) {
            $watering->FertilizerID = $request->input('FertilizerID');
            $watering->FertilizerDoze = $request->input('FertilizerDoze');
        }
        $watering->save();
        $watering_link = new Flower_Watering_Links();
        $watering_link->FlowerID = $id;
        $watering_link->WateringID = $watering->ID;

        $watering_link->save();

        return redirect()
            ->route('flowers.show', compact('id'))
            ->with('success', "wtr.added_d");
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store_transplantings(Request $request, $id)
    {
        $transplanting = new Flower_Transplantings();

        $transplanting->FlowerID = $id;
        $transplanting->TOPID = $request->input('TypeID');
        $transplanting->DOT = $request->input('DOT');
        $transplanting->SOP = $request->input('SOP');

        $transplanting->save();
        if (isset($_POST['soil_checkbox'])) {
            foreach ($_POST['soil_checkbox'] as $checkbox){
                $soil = new Flower_ST_Links();

                $soil->TPID = $transplanting->ID;
                $soil->SoilID = $checkbox;

                $soil->save();
            }
        }

        return redirect()
            ->route('flowers.show', compact('id'))
            ->with('success', "tp.added_d");
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store_diseases(Request $request, $id)
    {
        $disease = new Flower_DiseaseLink();

        $disease->FlowerID = $id;
        $disease->DiseaseID = $request->input('TypeID');

        $disease->save();

        return redirect()
            ->route('flowers.show', compact('id'))
            ->with('success', "disease.added_d");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $flowers = DB::table('flowers')
            ->where('ID', '=', $id)
            ->get();
        $old_shop = DB::table('flower_shop_links')
            ->join('flowers', 'flower_shop_links.FlowerID', '=', 'flowers.ID')
            ->join('shops', 'flower_shop_links.ShopID', '=', 'shops.ID')
            ->where('flowers.ID', '=', $id)
            ->get();
        $old_wrs = DB::table('flower_w_r_links')
            ->join('flowers', 'flower_w_r_links.FlowerID', '=', 'flowers.ID')
            ->join('watering_requirements', 'flower_w_r_links.WRID', '=', 'watering_requirements.ID')
            ->where('flowers.ID', '=', $id)
            ->get();
        $old_placements = DB::table('flower_placement_links')
            ->join('flowers', 'flower_placement_links.FlowerID', '=', 'flowers.ID')
            ->join('placements', 'flower_placement_links.PlacementID', '=', 'placements.ID')
            ->where('flowers.ID', '=', $id)
            ->get();
        $flower_imgs = DB::table('flower_images')
            ->where('FlowerID', '=', $id)
            ->get();
        $flower_img_main = DB::table('flower_images')
            ->where('FlowerID', '=', $id)
            ->where('IsMain', '=', true)
            ->get();
        $blooms = DB::table('flower_blooms')
            ->where('FlowerID', '=', $id)
            ->orderByDesc('BB')
            ->get();
        $diseases = DB::table('diseases')
            ->join('flower_disease_links', 'flower_disease_links.DiseaseID', '=', 'diseases.ID')
            ->where('flower_disease_links.FlowerID', '=', $id)
            ->orderByDesc('flower_disease_links.created_at')
            ->get();

        $waterings = DB::table('flower_watering_links')
            ->join('flower_waterings', 'flower_watering_links.WateringID', '=', 'flower_waterings.ID', 'left')
            ->where('flower_watering_links.FlowerID', '=', $id)
            ->orderByDesc('flower_waterings.WateringDate')
            ->get();
        $fertilizers = DB::table('fertilizers')
            ->get();
        $TOW = DB::table('watering_types_of')
            ->get();

        $transplantings = DB::table('flower_transplantings')
            ->where('flower_transplantings.FlowerID', '=', $id)
            ->orderByDesc('flower_transplantings.DOT')
            ->get();
        $st_l = DB::table('flower_s_t_links')
            ->join('soils', 'flower_s_t_links.SoilID', '=', 'soils.ID')
            ->get();
        $TOP = DB::table('types_of_planting')
            ->get();

        return view('flowers.show', compact(
            'flowers',
            'old_shop',
            'old_wrs',
            'old_placements',
            'flower_imgs',
            'flower_img_main',
            'blooms',
            'waterings',
            'diseases',
            'fertilizers',
            'TOW',
            'transplantings',
            'st_l',
            'TOP'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $flowers = DB::table('flowers')
            ->where('ID', '=', $id)
            ->get();

        $old_shop = DB::table('flower_shop_links')
            ->join('flowers', 'flower_shop_links.FlowerID', '=', 'flowers.ID')
            ->join('shops', 'flower_shop_links.ShopID', '=', 'shops.ID')
            ->where('flowers.ID', '=', $id)
            ->get();
        $old_wrs = DB::table('flower_w_r_links')
            ->join('flowers', 'flower_w_r_links.FlowerID', '=', 'flowers.ID')
            ->join('watering_requirements', 'flower_w_r_links.WRID', '=', 'watering_requirements.ID')
            ->where('flowers.ID', '=', $id)
            ->get();
        $old_placements = DB::table('flower_placement_links')
            ->join('flowers', 'flower_placement_links.FlowerID', '=', 'flowers.ID')
            ->join('placements', 'flower_placement_links.PlacementID', '=', 'placements.ID')
            ->where('flowers.ID', '=', $id)
            ->get();

        if (sizeof($old_shop)) {
            $shops = Shops::where('ID', '!=', $old_shop->first()->ID)
                ->get();
        } else {
            $old_shop = null;
            $shops = DB::table('shops')
                ->get();
        }

        if (sizeof($old_wrs)) {
            $wrs = Watering_Requirements::where('ID', '!=', $old_wrs->first()->ID)
                ->get();
        } else {
            $old_wrs = null;
            $wrs = DB::table('watering_requirements')
                ->get();
        }

        if (sizeof($old_placements)) {
            $placements = Placements::where('ID', '!=', $old_placements->first()->ID)
                ->get();
        } else {
            $old_placements = null;
            $placements = DB::table('placements')
                ->get();
        }

        return view('flowers.edit',
            compact('flowers',
                'old_shop',
                'old_wrs',
                'old_placements',
                'shops',
                'wrs',
                'placements'));
    }
    /**
     * Show the form for editing the specified resource.
     */

    public function edit_blooms(Request $request, $id)
    {
        $bloom = DB::table('flower_blooms')
            ->where('ID', '=', $id)
            ->first();
        return view('flowers.parts.bloom_edit', compact('bloom'));
    }
    /**
     * Show the form for editing the specified resource.
     */

    public function edit_waterings(Request $request, $id)
    {
        $watering = DB::table('flower_waterings')
            ->join('flower_watering_links', 'flower_waterings.ID', '=', 'flower_watering_links.WateringID', 'left')
            ->where('flower_waterings.ID', '=', $id)
            ->first();
        $old_type = DB::table('flower_waterings')
            ->join('watering_types_of', 'flower_waterings.TypeID', '=', 'watering_types_of.ID')
            ->where('flower_waterings.ID', '=', $id)
            ->first();

        if (!empty($old_type)) {
            $types = Watering_Types_Of::where('ID', '!=', $old_type->ID)
                ->get();
        } else {
            $old_type = null;
            $types = DB::table('watering_types_of')
                ->get();
        }
        $old_fertilizer = DB::table('flower_waterings')
            ->join('fertilizers', 'flower_waterings.FertilizerID', '=', 'fertilizers.ID')
            ->where('flower_waterings.ID', '=', $id)
            ->first();

        if (!empty($old_fertilizer)) {
            $fertilizers = Fertilizers::where('ID', '!=', $old_fertilizer->ID)
                ->get();
        } else {
            $old_fertilizer = null;
            $fertilizers = DB::table('fertilizers')
                ->get();
        }
        return view('flowers.parts.watering_edit', compact('watering',
            'types',
            'old_type',
            'fertilizers',
            'old_fertilizer'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit_transplantings(Request $request, $id)
    {
        $transplanting = DB::table('flower_transplantings')
            ->where('ID', '=', $id)
            ->first();
        $old_type = DB::table('flower_transplantings')
            ->join('types_of_planting', 'flower_transplantings.TOPID', '=', 'types_of_planting.ID', 'left')
            ->where('flower_transplantings.ID', '=', $id)
            ->first();

        if (!empty($old_type)) {
            $types = Types_of_Planting::where('ID', '!=', $old_type->ID)
                ->get();

        } else {
            $old_type = null;
            $types = DB::table('types_of_planting')
                ->get();
        }
        $old_soils = DB::table('flower_s_t_links')
            ->join('soils', 'soils.ID', '=', 'flower_s_t_links.SoilID', 'left')
            ->where('flower_s_t_links.TPID', '=', $id)
            ->get();
        if (!empty($old_soils)) {
            $soils = Soils::all();
            $old_soils_ids = $old_soils->pluck('SoilID');
            foreach ($old_soils_ids as $old_soils_id) {
                $soils = $soils->where('ID', '!=', $old_soils_id);
            }
//            $soils = Soils::where('ID', '!=', $old_soils_ids)
//                ->get();
        } else {
            $old_soils = null;
            $soils = DB::table('soils')
                ->get();
        }
        return view('flowers.parts.transplanting_edit', compact(
            'transplanting',
            'types',
            'old_type',
            'old_soils',
            'soils',
            'old_soils_ids'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $flower = Flowers::Find($id);
        $shop_link = Flower_Shop_Links::Where('FlowerID', '=', $id)
            ->first();
        $watering_req_link = Flower_WR_Links::Where('FlowerID', '=', $id)
            ->first();
        $placement_link = Flower_Placement_Links::Where('FlowerID', '=', $id)
            ->first();


        $flower->Name = $request->input('Name');
        $flower->DOB = $request->input('DOB');
        $flower->Size = $request->input('Size');
        $flower->Notes = $request->input('Notes');

        $flower->update();


//        placements validation check
        if (!empty($shop_link)) {
            if ($request->input('ShopID')) {
                if ($request->input('ShopID') != $shop_link->ShopID) {
                    $shop_link->delete();
                    $shop_link = new Flower_Shop_Links();
                    $shop_link->FlowerID = $id;
                    $shop_link->ShopID = $request->input('ShopID');
                    $shop_link->save();
                }
            } else {
                $shop_link->delete();
            }
        } else {
            if ($request->input('ShopID')) {
                $shop_link = new Flower_Shop_Links();
                $shop_link->FlowerID = $id;
                $shop_link->ShopID = $request->input('ShopID');
                $shop_link->save();
            }
        }
//        placements validation check
        if (!empty($watering_req_link)) {
            if ($request->input('WRID')) {
                if ($request->input('WRID') != $watering_req_link->WRID) {
                    $watering_req_link->delete();
                    $watering_req_link = new Flower_WR_Links();
                    $watering_req_link->FlowerID = $id;
                    $watering_req_link->WRID = $request->input('WRID');
                    $watering_req_link->save();
                }
            } else {
                $watering_req_link->delete();
            }
        } else {
            if ($request->input('WRID')) {
                $watering_req_link = new Flower_WR_Links();
                $watering_req_link->FlowerID = $id;
                $watering_req_link->WRID = $request->input('WRID');
                $watering_req_link->save();
            }
        }
//        placements validation check
        if (!empty($placement_link)) {
            if ($request->input('PlacementID')) {
                if ($request->input('PlacementID') != $placement_link->PlacementID) {
                    $placement_link->delete();
                    $placement_link = new Flower_Placement_Links();
                    $placement_link->FlowerID = $id;
                    $placement_link->PlacementID = $request->input('PlacementID');
                    $placement_link->save();
                }
            } else {
                $placement_link->delete();
            }
        } else {
            if ($request->input('PlacementID')) {
                $placement_link = new Flower_Placement_Links();
                $placement_link->FlowerID = $id;
                $placement_link->PlacementID = $request->input('PlacementID');
                $placement_link->save();
            }
        }
        return redirect()
            ->route('flowers.show', compact('id'))
            ->with('success', "flower.edited_d");
    }

    public function update_img($id)
    {
        $flower_img = Flower_Images::find($id);
        $flower_ID = $flower_img->FlowerID;
        $flower_imgs_main = Flower_Images::where('FlowerID', '=', $flower_ID)
            ->where('IsMain', '=', true)
            ->get();
        foreach ($flower_imgs_main as $flower_img_main) {
            $flower_img_main->IsMain = false;
            $flower_img_main->update();
        }
        $flower_img->IsMain = true;
        $flower_img->update();
        $id = $flower_ID;
        return redirect()
            ->route('flowers.show', compact('id'))
            ->with('success', "flower.main_img");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_blooms(Request $request, $id)
    {
        $bloom = Flower_Blooms::find($id);

        $bloom->BB = $request->input('BB');
        $bloom->BE = $request->input('BE');

        $bloom->update();
        $id = $bloom->FlowerID;
        return redirect()
            ->route('flowers.show', compact('id'))
            ->with('success', 'bloom.edited_d');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update_waterings(Request $request, $id)
    {
        $watering = Flower_Waterings::find($id);

        if ($request->input('TypeID')) {
            $watering->TypeID = $request->input('TypeID');
        }
        if ($request->input('WateringDate')) {
            $watering->WateringDate = $request->input('WateringDate');
        }
        if ($request->input('FertilizerID')) {
            $watering->FertilizerID = $request->input('FertilizerID');
            $watering->FertilizerDoze = $request->input('FertilizerDoze');
        }
        $watering->update();

        $flower_watering_links = DB::table('flower_watering_links')
            ->where('WateringID', '=', $id)
            ->first();

        $id = $flower_watering_links->FlowerID;

        return redirect()
            ->route('flowers.show', compact('id'))
            ->with('success', 'wtr.edited_d');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_transplantings(Request $request, $id)
    {
        $transplanting = Flower_Transplantings::find($id);

        if ($request->input('TypeID')) {
            $transplanting->TOPID = $request->input('TypeID');
        }
        if ($request->input('DOT')) {
            $transplanting->DOT = $request->input('DOT');
        }
        if ($request->input('SOP')) {
            $transplanting->SOP = $request->input('SOP');
        }
        $transplanting->update();

        $old_soils = Flower_ST_Links::where('TPID', '=', $transplanting->ID);
        $old_soils->delete();
        if (isset($_POST['soil_checkbox'])) {
            foreach ($_POST['soil_checkbox'] as $checkbox){
                $soil = new Flower_ST_Links();

                $soil->TPID = $transplanting->ID;
                $soil->SoilID = $checkbox;

                $soil->save();
            }
        }
        $id = $transplanting->FlowerID;

        return redirect()
            ->route('flowers.show', compact('id'))
            ->with('success', 'tp.edited_d');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $flower_imgs = DB::table('flower_images')
            ->where('FlowerID', '=', $id)
            ->delete();
        $blooms = DB::table('flower_blooms')
            ->where('FlowerID', '=', $id)
            ->delete();

        $transplantings = DB::table('flower_transplantings')
            ->where('FlowerID', '=', $id)
            ->get();
        foreach ($transplantings as $transplanting) {

                $flower_st_link = DB::table('flower_s_t_links')
                    ->where('TPID', '=', $transplanting->ID)
                    ->delete();
        }
        $transplantings = DB::table('flower_transplantings')
            ->where('FlowerID', '=', $id)
            ->delete();

        $watering_links = DB::table('flower_watering_links')
            ->where('FlowerID', '=', $id)
            ->get();
        foreach ($watering_links as $watering_link) {
            $watering_l = DB::table('flower_watering_links')
                ->where('ID', '=', $watering_link->ID)
                ->delete();
            $watering = DB::table('flower_waterings')
                ->where('ID', '=', $watering_link->WateringID)
                ->delete();
        }

        $disease = DB::table('flower_disease_links')
            ->where('FlowerID', '=', $id)
            ->delete();
        $shop = DB::table('flower_shop_links')
            ->where('FlowerID', '=', $id)
            ->delete();
        $wrs = DB::table('flower_w_r_links')
            ->where('FlowerID', '=', $id)
            ->delete();
        $places = DB::table('flower_placement_links')
            ->where('FlowerID', '=', $id)
            ->delete();
        $flower = DB::table('flowers')
            ->where('ID', '=', $id)
            ->delete();

        return redirect()
            ->route('flowers.index')
            ->with('warning', "flower.deleted_d");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy_img($id)
    {
        $flower_img = Flower_Images::find($id);
        $flower_ID = $flower_img->FlowerID;
        if ($flower_img->IsMain) {
            $flower_img->delete();
            $flower_first = Flower_Images::where('FlowerID', '=', $flower_ID)
                ->first();
            if (isset($flower_first)) {
                $flower_first->IsMain = true;
                $flower_first->update();
            }
        }
        $flower_img->delete();
        $id = $flower_ID;
        return redirect()
            ->route('flowers.show', compact('id'))
            ->with('success', "flower.deleted_img");
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy_blooms($id)
    {
        $bloom = Flower_Blooms::find($id);
        $id = $bloom->FlowerID;
        $bloom->delete();

        return redirect()
            ->route('flowers.show', compact('id'))
            ->with('warning', "bloom.deleted_d");
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy_waterings($id)
    {
        $watering = Flower_Waterings::find($id);
        $watering_link = Flower_Watering_Links::where('WateringID', '=', $id)->first();
        $id = $watering_link->FlowerID;
        $watering_link->delete();

        return redirect()
            ->route('flowers.show', compact('id'))
            ->with('warning', "wtr.deleted_link");
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy_transplantings($id)
    {
        $transplanting = Flower_Transplantings::find($id);

        $transplanting_link = Flower_ST_Links::where('TPID', '=', $id)->get();

        foreach ($transplanting_link as $link){
            $link->delete();
        }

        $id = $transplanting->FlowerID;

        $transplanting->delete();

        return redirect()
            ->route('flowers.show', compact('id'))
            ->with('warning', "tp.deleted_d");
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy_diseases($id)
    {
        $disease = Flower_DiseaseLink::find($id);
        $id = $disease->FlowerID;
        $disease->delete();

        return redirect()
            ->route('flowers.show', compact('id'))
            ->with('warning', "disease.deleted_d");
    }

}
