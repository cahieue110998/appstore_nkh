<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $product = Product::all();
        $order = Order::all();
        $user = User::all();
        view()->share(['product'=>$product,'order'=>$order,'user'=>$user]);
    }

    public function index(){

        return view('admin.pages.index');
    }
}
