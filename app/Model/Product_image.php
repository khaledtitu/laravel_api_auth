<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product_image extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
	  'image','product_id'
	];
}
