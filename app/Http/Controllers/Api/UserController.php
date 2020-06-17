<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\Api\UserRequest;
use App\Models\User;
use App\Http\Resources\Api\UserResource;
use Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $num  = $request->input('num', 3);

        $map['status'] = 1;
        $data['data']  = User::where($map)->skip(($page - 1) * $num)->take($num)->get();
        $data['total'] = User::where($map)->count();
        return $this->success($data);
    }

    // 用户注册
    public function store(UserRequest $request)
    {
        User::create($request->all());
        return $this->created();
    }

    // 返回当前登录用户信息
    public function info()
    {
        $admins = Auth::user();
        return $this->success(new UserResource($admins));
    }

    // 用户登录
    public function login(UserRequest $request)
    {
        $present_guard = Auth::getDefaultDriver();
        $token         = Auth::claims(['guard' => $present_guard])->attempt(['name' => $request->name, 'password' => $request->password]);
        if ($token) {
            return $this->success(['token' => 'Bearer ' . $token]);
        }
        return $this->failed('账号或密码错误', 400);
    }

    // 用户退出
    public function logout()
    {
        Auth::logout();
        return $this->success('退出成功...');
    }

}
