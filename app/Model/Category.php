<?php

namespace App\Model;

use App\Model\Product;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{   


    /**
     * @var array
     */
	protected $fillable = [
	  'name','status'
	];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
	public function products(){

		return $this->hasMany(Product::class);
	}
    
}
