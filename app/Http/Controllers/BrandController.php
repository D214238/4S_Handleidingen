<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Type;
use App\Models\Manual;
use DB;

class BrandController extends Controller
{
    public function show($brand_id, $brand_slug)
    {

        $brand = Brand::findOrFail($brand_id);
        $types = Type::where('brand_id', $brand_id)->orderBy('name')->get();
        $type_ids = Type::where('brand_id', $brand_id)->pluck('id');
        $manual_ids = DB::table('manual_type')->whereIn('type_id', $type_ids)->pluck('manual_id');
        $manuals = Manual::whereIn('id', $manual_ids)->get();

        return view('pages/type_list', [
            "types"=>$types,
            "brand"=>$brand,
            "manuals"=>$manuals
        ]);

    }
}
