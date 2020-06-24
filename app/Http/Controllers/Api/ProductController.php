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
        echo 'product';
        $data = array(
            'id'    => 1,
            'title' => 'product-1',
            'images' => '/abc.png',
            'price'  => 12.01
        );
        // $model = new MongoProduct();

        // dump($model);
        try {
            // echo phpinfo();
            // $client = new \MongoDB\Client(
            //     'mongodb://localhost/test?retryWrites=true&w=majority'
            // );

            // $db = $client->test;

            // $product = MongoProduct::create($data);
            $product = MongoProduct::first();
            dump($product);
            // $product = MongoProduct::paginate(2);
            // $product = MongoProduct::where('_id', '5ef027b37191c9590661e62f')->orderBy('_id', 'desc')->first();
            // $users = DB::collection('users')->get();
            // $user = DB::collection('users')->where('name', 'John')->first();


            // \DB::collection('users')               //选择使用users集合
            // ->insert([                          //插入数据
            //     'name'  =>  'tom',
            //     'age'     =>   18
            // ]);
            //
            // $res = \DB::collection('users')->all();
            // dump($product);
        }catch (\Exception $e)
        {
            dump($e);
        }

        // $product = MongoProduct::all();

    }


}
