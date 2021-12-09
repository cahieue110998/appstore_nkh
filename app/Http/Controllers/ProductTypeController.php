<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ProductType;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductTypeRequest;
use Illuminate\Support\Facades\Validator;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productType = ProductType::paginate(5);
        return view('admin.pages.producttype.list',compact('productType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('status',1)->get();
        return view('admin.pages.producttype.add',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductTypeRequest $request)
    {
        $data = $request->all();
        $data['slug'] = utf8tourl($request->name);
        if(ProductType::create($data)){
            return redirect()->route('producttype.index')->with('thongbao','Thêm thành công loại sản phẩm');
        }
        else{
            return back()->with('thongbao','Có lõi xảy ra xin kiểm tra lại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $producttype = ProductType::findOrFail($id);
        $category = Category::where('status',1)->get();
        return response()->json(['category'=>$category,'producttype'=>$producttype],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $validator = Validator::make($request->all(),
            [
                'name'=>'required|min:2|max:255|unique:product_types,name,'.($request->id ?? ''),
            ],
            [
                'name.required'=>'Tên loại sản phẩm không được bỏ trống',
                'name.min'=>'Tên loại sản phẩm tối thiểu có 2 ký tự',
                'name.max'=>'Tên loại sản phẩm tối đa 255 ký tự',
                'unique'=>'Tên loại sản phẩm đã tồn tại trong hệ thống',
            ]
        );
        if($validator->fails()){
            return response()->json(['errors' =>'true', 'message' => $validator->errors()],200);
        }
        $producttype = ProductType::findOrFail($id);
        $data = $request->all();
        $data['slug'] = utf8tourl($request->name);
        if($producttype->update($data)){
            return response()->json(['result'=>'Đã sửa thành công loại sản phẩm '.$request->name],200);
        }
        else{
            return response()->json(['errors'=>'Sửa không thành công loại sản phẩm có id là '.$id],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $producttype = ProductType::findOrFail($id);
        if(count($producttype->Products) === 0){
            $producttype->delete();
            return response()->json(['success'=>'Đã xóa thành công loại sản phẩm '.$producttype->name],200);
        }
        else{
            return response()->json(['success'=>'Không thể xóa khi còn Product theo ProductType ('.$producttype->name.') này']);
        }
    }

    // End Admin

    // Client
    public function get_producttype($producttype_id){
        $category = Category::where('status',1)->orderBy('id','desc')->get();
        $producttype = ProductType::where('status',1)->orderBy('id','desc')->get();
        $producttype_product = Product::where('products.idProductType',$producttype_id)->get();
        $producttype_name = ProductType::where('product_types.id',$producttype_id)->limit(1)->get();
        return view('client.pages.producttype.protype',compact('category','producttype','producttype_product','producttype_name'));
    }
}
