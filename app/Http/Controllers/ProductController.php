<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::paginate(5);
        return view('admin.pages.product.list',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('status',1)->get();
        $producttype = ProductType::where('status',1)->get();
        return view('admin.pages.product.add',compact('category','producttype'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        if($request->hasFile('image')){
            $file = $request->image;
            //lấy tên file
            $file_name = $file->getClientOriginalName();
            //lấy loại file
            $file_type = $file->getMimeType();
            //lấy kích thước file với đơn vị byte
            $file_size = $file->getSize();
            if($file_type =='image/png' || $file_type =='image/jpg' || $file_type =='image/jpeg' || $file_type =='image/gif'){
                if($file_size <= 1048576){
                    $file_name = date('D-m-y').'-'.rand().'-'.utf8tourl($file_name);
                    if($file->move('img/upload/product',$file_name)){
                        $data = $request->all();
                        $data['slug'] = utf8tourl($request->name);
                        $data['image'] = $file_name;
                        Product::create($data);
                        return redirect()->route('product.index')->with('thongbao', "'Đã thêm thành công sản phẩm : '$request->name");
                    }
                }
                else{
                    return back()->with('error','Bạn không thể upload ảnh quá 5mb');
                }
            }
            else{
                return back()->with('error','File bạn chọn không phải là hình ảnh');
            }
        }
        else{
            return back()->with('error','Bạn chưa thêm ảnh minh họa cho sản phẩm');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::where('status',1)->get();
        $producttype = ProductType::where('status',1)->get();
        $product = Product::findOrFail($id);
        return response()->json(['category'=>$category,'producttype'=>$producttype,'product'=>$product],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $id
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'name'=>'required|min:2|max:255|unique:products,name,'.($request->id ?? ''),
                'description'=>'nullable',
                'quantity'=>'required|numeric',
                'price'=>'required|numeric',
                'promotional'=>'numeric',
                'image'=>($request->id ? 'nullable' : 'required').'|image',
            ],
            [
                'required' => ':attribute không được bỏ trống',
                'min' => ':attribute tối thiểu có 2 ký tự',
                'max' => ':attribute tối đa có 2 ký tự',
                'numeric' => ':attribute phải là một số',
                'image' => ':attribute không phải hình ảnh',
                'unique'=>':attribute đã tồn tại trong hệ thống',
            ],
            [
                'name'=>'Tên sản phẩm',
                'description'=>'Mô tả sản phẩm',
                'quantity'=>'Số lượng sản phẩm',
                'price'=>'Đơn giá sản phẩm',
                'promotional'=>'Giá khuyến mại',
                'image'=>'Ảnh minh họa',
            ]
        );
        if($validator->fails()){
            return response()->json(['errors' =>'true', 'message' => $validator->errors()],200);
        }
        $product = Product::findOrFail($id);
        $data = $request->all();
        $data['slug'] = utf8tourl($request->name);
        if($request->hasFile('image')){
            $file = $request->image;
            //lấy tên file
            $file_name = $file->getClientOriginalName();
            //lấy loại file
            $file_type = $file->getMimeType();
            //lấy kích thước file với đơn vị byte
            $file_size = $file->getSize();
            if($file_type =='image/png' || $file_type =='image/jpg' || $file_type =='image/jpeg' || $file_type =='image/gif'){
                if($file_size <= 1048576){
                    $file_name = date('D-m-y').'-'.rand().'-'.utf8tourl($file_name);
                    if($file->move('img/upload/product',$file_name)){

                        $data['image'] = $file_name;
                        if(File::exists('img/upload/product'.$product->image)){
                            // Delete File
                            unlink('img/upload/product'.$product->image);
                        }
                    }
                }
                else{
                    return response()->json(['error'=>'Upload file dưới 1MB'],200);
                }
            }
            else{
                return response()->json(['error'=>'File bạn chọn không phải là hình ảnh'],200);
            }
        }
        else{
            $data['image'] = $product->image;
        }
        $product->update($data);
        return response()->json(['result'=>'Đã sửa thành công sản phẩm'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if(File::exists('img/upload/product/'.$product->image)){
            unlink('img/upload/product/'.$product->image);
        }
        $product->delete();
        return response()->json(['result'=>'Đã xóa thành công sản phẩm có tên là '.$product->name],200);
    }
    //end admin

    //client
    public function details_product($product_id){
        $category = Category::where('status',1)->orderBy('id','desc')->get();
        $producttype = ProductType::where('status',1)->orderBy('id','desc')->get();
        $product_details = Product::where('products.id',$product_id)->get();
        foreach($product_details as $key=>$value){
            $protype_id = $value->idProductType;
        }
        $product_related = Product::where('products.idProductType',$protype_id)->whereNotIn('products.id',[$product_id])->get();

        return view('client.pages.product.details_pro',compact('category','producttype','product_details','product_related'));
    }
}
