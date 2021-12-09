<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validator = Validator::make($request->all(),
        [
            'email' =>'required|email',
            'phone' => 'required|numeric',
            'address' => 'required|min:2|max:255',
        ],
        [
            'required' => ':attribute không được bỏ trống',
            'email' => ':attribute không đúng định dạng email',
            'numeric' => ':attribute không đúng định dạng số',
            'min' => ':attribute tối thiểu có 2 ký tự',
            'max' => ':attribute tối đa 255 ký tự',
        ],
        [
            'email' => 'Địa chỉ email',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ nhận hàng',
        ]);
        if($validator->fails()){
            return response()->json(['errors' =>'true', 'message' => $validator->errors()],200);
        }
        else{
            $data = $request->only('email','phone','address');
            $data['idUser'] = Auth::user()->id;
            if($request->active = 'on'){
                $data['active'] = 1;
                $customer = Customer::where('idUser',Auth::user()->id)->where('active',1)->first();
                if(!empty($customer)){
                    $customer->active = 0;
                    $customer->save();
                }
            }
            else{
                $data['active'] = 0;
            }
            Customer::create($data);
            return response()->json('Đã thêm địa chỉ nhận hàng thành công',200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
