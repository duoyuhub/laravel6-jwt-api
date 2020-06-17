<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Admin\AdminRequest;
use App\Http\Resources\Admin\AdminResource;
use App\Models\Admin;
use Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $users = Admin::paginate(3);

        return AdminResource::collection($users);
    }

    // 用户注册
    public function store(AdminRequest $request){
        Admin::create($request->all());
        return '用户注册成功。。。';
    }

    // 返回当前登录用户信息
    public function info(){
        $admins = Auth::user();
        return $this->success(new AdminResource($admins));
    }

    // 用户登录
    public function login(AdminRequest $request){
        $present_guard =Auth::getDefaultDriver();
        $token=Auth::claims(['guard'=>$present_guard])->attempt(['name'=>$request->name,'password'=>$request->password]);
        if($token) {
            return $this->success(['token' => 'bearer ' . $token]);
        }
        return $this->failed('账号或密码错误',400);
    }

    // 用户退出
    public function logout(){
        Auth::logout();
        return $this->success('退出成功...');
    }
}
