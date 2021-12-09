<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ProductType;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $category = Category::paginate(5);
        if($user->can('view',Category::class)){
            return view('admin.pages.category.list',compact('category'));
        }
        else{
            return back()->with('error','Bạn không có quyền truy cập trang DANH MỤC SẢN PHẨM');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if($user->can('create',Category::class)){
            return view('admin.pages.category.add');
        }
        else{
            return back()->with('error','Bạn không có quyền truy cập trang DANH MỤC SẢN PHẨM');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $user = Auth::user();
        if($user->can('create',Category::class)){
            $data = $request->all();
            $data['slug'] = utf8tourl($request->name);
            if(Category::create($data)){
                return redirect()->route('category.index')->with('thongbao','Thêm thành công danh mục sản phẩm');
            }
        }
        else{
            return back()->with('error','Bạn không có quyền truy cập trang DANH MỤC SẢN PHẨM');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $category = Category::findOrFail($id);
        if($user->can('update',Category::class)){
            return response()->json($category,200);
        }
        else{
            return back()->with('error','Bạn không có quyền truy cập trang DANH MỤC SẢN PHẨM');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if($user->can('update',Category::class)){
            $validator = Validator::make($request->all(),
            [
                'name' => 'required|min:2|max:255|unique:categories,name,'.($request->id ?? ''),
            ],
            [
                'required'=>'Tên danh mục sản phẩm không được để trống',
                'min'=>'Tên danh mục sản phẩm phải từ 2-255 ký tự',
                'max'=>'Tên danh mục sản phẩm phải từ 2-255 ký tự',
                'unique'=>'Tên danh mục sản phẩm đã tồn tại trong hệ thống',
            ]);
            if($validator->fails()){
                return response()->json(['errors' =>'true', 'message' => $validator->errors()],200);
            }
            $category = Category::findOrFail($id);
            $category->update([
                    'name' => $request->name,
                    'slug' => utf8tourl($request->name),
                    'status' => $request->status,
            ]);
            return response()->json(['success'=>'Sửa thành công']);
        }
        else{
            return back()->with('error','Bạn không có quyền truy cập trang DANH MỤC SẢN PHẨM');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if($user->can('delete',Category::class)){
            $category = Category::findOrFail($id);
            if(count($category->productTypes)===0){
                $category->delete();
                return response()->json(['success'=>'Xóa thành công'.$category->name]);
            }
            else{
                return response()->json(['success'=>'Không thể xóa khi còn ProductType theo Category ('.$category->name.') này']);
            }
        }
        else{
            return back()->with('error','Bạn không có quyền truy cập trang DANH MỤC SẢN PHẨM');
        }
    }

    // End Admin

    // Client
    public function get_category($category_id){
        $category = Category::where('status',1)->orderBy('id','desc')->get();
        $producttype = ProductType::where('status',1)->orderBy('id','desc')->get();
        $category_product = Product::where('products.idCategory',$category_id)->get();
        $category_name = Category::where('categories.id',$category_id)->limit(1)->get();
        return view('client.pages.category.category_product',compact('category','producttype','category_product','category_name'));
    }
}
