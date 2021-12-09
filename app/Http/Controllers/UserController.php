<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function redirectProvider($social){
        return Socialite::driver($social)->redirect();
    }

    public function handleProviderCallback($social){
        $user = Socialite::driver($social)->user();
        $authUser = $this->findOrCreateUser($user);
        Auth::login($authUser);
        return back()->with('thongbao','Đăng nhập thành công');
    }

    private function findOrCreateUser($user){
        $authUser = User::where('social_id',$user->id)->first();
        if($authUser){
            return $authUser;
        }
        else{
            return User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => '',
                    'social_id' => $user->id,
                    'ruler' => 0,
                    'status' => 0,
                    'avatar' => $user->avatar,
            ]);
        }
    }

    public function logout(){
        if(Auth::check()){
            Auth::logout();
            return redirect('/')->with('thongbao','Đăng xuất thành công');
        }
    }

    public function updatePassClient(Request $request){
        $this->validate($request,
            [
                'password' => 'required|min:6|max:255',
                're_password' => 'required|same:password',
            ],
            [
                'password.required'=>'Mật khẩu không được để trống',
                'password.min'=>'Mật khẩu phải có tối thiểu 6 ký tự',
                'password.max'=>'Mật khẩu phải tối đa có 255 ký tự',
                're_password.required'=>'Không được để trống',
                're_password.same'=>'Mật khẩu không đúng với trường mật khẩu',
            ]
        );
        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('thongbao','Đã cập nhật mật khẩu thành công');
    }

    public function loginClient(Request $request){
        $data = $request->only('email','password');
        if(Auth::attempt($data,$request->has('remember'))){
            return back()->with('thongbao','Đăng nhập thành công');
        }
        else{
            return back()->with('error','Đăng nhập thất bại. Xin vui lòng kiểm tra lại tài khoản');
        }
    }

    public function registerClient(Request $request){
        $this->validate($request,
        [
            'name' => 'required|min:2|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:255',
            're_password' => 'required|same:password',
        ],
        [
            'name.required'=>'Họ tên không được để trống',
            'name.min'=>'Họ tên phải có tối thiểu 2 ký tự',
            'name.max'=>'Họ tên tối đa có 255 ký tự',
            'email.required'=>'Email không được để trống',
            'email.email'=>'Email bạn nhập không đúng định dạng',
            'email.unique'=>'Email đã tồn tại trong hệ thống',
            'password.required'=>'Mật khẩu không được để trống',
            'password.min'=>'Mật khẩu phải có tối thiểu 6 ký tự',
            'password.max'=>'Mật khẩu phải tối đa có 255 ký tự',
            're_password.required'=>'Không được để trống',
            're_password.same'=>'Mật khẩu không đúng với trường mật khẩu',
        ]
        );
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        Auth::login($user);
        return back()->with('thongbao','Đăng ký thành công');
    }

    public function loginAdmin(Request $request){
        $data = $request->only('email','password');
        if(Auth::attempt($data,$request->has('remember'))){
            if(Auth::user()->role == 1)
                return redirect('admin')->with('thongbao','Đăng nhập thành công');
            else if(Auth::user()->role == 2)
                return redirect()->route('category.index')->with('thongbao','Đăng nhập thành công');
            else if(Auth::user()->role == 3)
                return redirect()->route('product.index')->with('thongbao','Đăng nhập thành công');
            else if(Auth::user()->role == 4)
                return redirect()->route('order.index')->with('thongbao','Đăng nhập thành công');
        }
        else{
            return redirect()->route('admin.login')->with('error','Đăng nhập thất bại. Xin vui lòng kiểm tra lại tài khoản');
        }
    }

    public function logoutAdmin(){
        if(Auth::check()){
            Auth::logout();
            return redirect()->route('login.admin')->with('thongbao','Đăng xuất thành công');        }
    }
}
