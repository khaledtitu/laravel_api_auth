<?php

namespace App\Http\Controllers;

use App\Model\Product_image;
use Illuminate\Http\Request;

use App\Http\Resources\ProductImagesResource;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //return Product_image::all();

       return ProductImagesResource::collection(Product_image::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $inputs = $request->all();
            $dir='upload/images';
            $current_timestamp = Carbon::now()->timestamp;
            $image = 'im_' . $current_timestamp . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs($dir, $image);
            $inputs['image'] = $image;
            $image_name=Product_image::create($inputs);

            return response()->json([
                'message' => 'Created successfully ',
                'data' => $image_name,
            ], 201);


            //Flash::success('Ad created successfully.');
        } catch (\Exception $exception) {

            return response()->json([
                    'message' => $exception->getMessage(),
                ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product_image  $product_image
     * @return \Illuminate\Http\Response
     */
    public function show(Product_image $product_image)
    {
        try { 

          return new ProductImagesResource($Product_image);

        }catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product_image  $product_image
     * @return \Illuminate\Http\Response
     */
    public function edit(Product_image $product_image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product_image  $product_image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product_image $product_image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product_image  $product_image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product_image $product_image)
    {
        //
    }
}
