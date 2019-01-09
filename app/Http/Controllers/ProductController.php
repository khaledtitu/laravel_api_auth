<?php

namespace App\Http\Controllers;

use App\Model\Product;

use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Http\Requests\StoreProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       //return ProductResource::collection(Product::all());
        return new ProductCollection(Product::paginate(10));
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
    public function store(StoreProduct $request)
    {

        try { 

            $product = new Product;
            $product->name = $request->name;
            $product->detail = $request->description;
            $product->stock = $request->stock;
            $product->user_id = $request->user_id;
            $product->category_id = $request->category_id;
            $product->price = $request->price;
            $product->discount = $request->discount;
            $product->save();
            return response([
                'data' => new ProductResource($product)
            ],201);


        }catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }

      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

        try { 

          return new ProductResource($product);

        }catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
       

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        try { 

            $request['detail'] = $request->description;
             unset($request['description']);
            $product->update($request->all());
            return response([
                'data' => new ProductResource($product)
            ],201);

        }catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
       

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try { 

            $product->delete();
            return response(null,204);

        }catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }

        
    }


    /**
     * get category wise productData.
     *
     * 
     * @return \Illuminate\Http\Response
     */

    public function catProduct(Request $request, $id)
    {
        try { 
            return new ProductCollection(Product::where('category_id',$id)->paginate(10));

        }catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }

        
    }



}
