<?php

namespace App\Model;

use App\Model\Product;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

	/**
     * @var array
     */
    protected $fillable = [
		'star','customer','review'
	];
	
	/**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product()
    {
    	return $this->belongsTo(Product::class); 
    }
}
