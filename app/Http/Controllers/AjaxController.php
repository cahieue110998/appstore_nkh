<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ProductType;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getProductType(Request $request){
        $productType = ProductType::where('idCategory',$request->idCate)->get();
        return response()->json($productType,200);
    }
}
