<?php

namespace App\Http\Controllers;

use App\Mail\ShoppingMail;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function __construct()
    {
        $category = Category::where('status',1)->orderBy('id','asc')->limit(6)->get();
        $producttype = ProductType::where('status',1)->orderBy('id','asc')->limit(8)->get();
        $product = Product::where('status',1)->orderBy('id','desc')->limit(5)->get();
        view()->share(['category'=>$category,'producttype'=>$producttype,'product'=>$product]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::content();
        return view('client.pages.cart.cart',compact('cart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['idUser'] = Auth::user()->id;
        $data['code_order'] = 'oder'.rand();
        $data['money'] = str_replace(',','',$request->money);
        $data['status'] = 0;
        $order = Order::create($data);
        $idOder = $order->id;
        $orderdetail = [];
        $orderdetails = [];
        foreach(Cart::content() as $key => $cart){
            $orderdetail['idOrder'] = $idOder;
            $orderdetail['idProduct'] = $cart->id;
            $orderdetail['quantity'] = $cart->qty;
            $orderdetail['price'] = $cart->price;
            $orderdetails[$key] = OrderDetail::create($orderdetail);
        }
        Mail::to($order->email)->send(new ShoppingMail($order,$orderdetails));
        Cart::destroy();
        return response()->json('Đã mua hàng thành công',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->ajax()){
            Cart::update($id,$request->qty);
            return response()->json(["result" => "Đã cập nhật số lượng sản phẩm thành công"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);
        return response()->json(['result'=>'Đã xóa thành công sản phẩm']);
    }

    public function addCart($id, Request $request){
        $product = Product::find($id);
        if($request->qty){
            $qty = $request->qty;
        }
        else{
            $qty = 1;
        }
        if($product->promotional>0){
            $price = $product->promotional;
        }
        else{
            $price = $product->price;
        }
        $cart = ['id'=>$id, 'name'=>$product->name, 'qty'=>$qty, 'price'=>$price,'weight'=>$price, 'options'=>['img'=>$product->image]];
        if(Auth::check()){
            Cart::add($cart);
            return redirect()->route('cart.index')->with('thongbao', 'Đã thêm sản phẩm '.$product->name.' vào giỏ hàng thành công');
        }
        else{
            return back()->with('error','Bạn chưa đăng nhập');
        }
    }

    public function checkout(){
        $user = Auth::user();
        $price = str_replace(',','',Cart::total());
        return view('client.pages.checkout.checkout',compact('user','price'));
    }
}
