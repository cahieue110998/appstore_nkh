<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $category = Category::where('status',1)->orderBy('id','asc')->limit(6)->get();
        $producttype = ProductType::where('status',1)->orderBy('id','asc')->limit(8)->get();
        $product = Product::where('status',1)->orderBy('id','desc')->limit(11)->get();
        view()->share(['category'=>$category,'producttype'=>$producttype,'product'=>$product]);
    }

    public function index(){
        return view('client.pages.index');
    }

    public function search(Request $request){
        $pro_search = Product::where('name','like','%'.$request->keywords.'%')->get();
        return view('client.pages.product.search',compact('pro_search'));
    }
}
