<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MongoProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {

        $data = array(
            'id'    => 1,
            'title' => 'product-1',
            'images' => '/abc.png',
            'price'  => 12.01
        );

        try {
            /* 测试mongodb驱动是否有效 */
            // echo phpinfo();
            // $client = new \MongoDB\Client(
            //     'mongodb://localhost/test?retryWrites=true&w=majority'
            // );
            // $db = $client->test;

            /* 模型 添加产品 */
            $product = MongoProduct::create($data);
            dump($product);
            $product = MongoProduct::first();
            dump($product);

            /* DB 添加用户 */
            // \DB::collection('users')               //选择使用users集合
            // ->insert([                          //插入数据
            //     'name'  =>  'tom',
            //     'age'     =>   18
            // ]);
            // $users = \DB::collection('users')->get();
            // $user = \DB::collection('users')->where('name', 'John')->first();
            // $res = \DB::collection('users')->all();
            // dump($res);

        }catch (\Exception $e){
            dump($e);
        }


    }


}
