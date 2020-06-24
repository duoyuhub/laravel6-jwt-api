<?php

namespace App\Models;

Use Jenssegers\Mongodb\Eloquent\Model;

class MongoProduct extends Model
{
    //
    protected $connection = 'mongodb';

    protected $collection = 'products';

    // protected $primaryKey = 'id';

    protected $guarded = [];

    protected $dates = ['created_at', 'updated_at'];


}
