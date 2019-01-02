<?php

namespace App\Model;

use App\Model\Review;
use App\Model\Category;
use App\Model\Product_image;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    /**
     * @var array
     */
    protected $fillable = [
	  'name','detail','stock','price','discount','user_id','category_id'
	];

	/**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
    	return $this->hasMany(Review::class); 
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
    	return $this->belongTo(User::class); 
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categories()
    {
        return $this->belongTo(Category::class); 
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product_image()
    {
    	return $this->hasMany(Product_image::class); 
    }


}
