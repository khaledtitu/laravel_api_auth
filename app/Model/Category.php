<?php

namespace App\Model;

use App\Model\Product;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{   

	protected $fillable = [
	  'name','status'
	];

	public function products(){

		return $this->hasMany(Product::class);
	}
    
}
