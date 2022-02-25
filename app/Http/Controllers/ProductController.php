<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Resources\ProductResource;
use App\Services\ProductBuilder;
use App\Traits\ActivityTrait;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $productBuilder;

    use ActivityTrait;

    // public function __construct(ProductBuilder $productBuilder)
    // {
    //     $this->productBuilder = $productBuilder;
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $products = DB::table('products')->get();

        //$products = Product::all();

        return $products;

        //return ProductResource::collection(Product::all());

        // $role = $this->getUserRole();

        // Log::info($role);

        // if($role['level'] == 'admin') {
            
        //     return $this->indexAdmin($request);
        // }

        // else if($role['level'] == 'user') {

        //     if(!array_key_exists('entity', $role)) return $this->getResponse(404, 'No menu found.');
          
        //     return $this->indexUser($role['entity'], $request);
        // }

        // return $this->getResponse(400, 'Bad Request');
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
        //
        $request->validate([
            'name'=>'required|string|unique:products|max:255',
        ]);

        $product = new Product();
        $product->name = $request->name;

        // Get a unique slug
        $product->slug = $this->createSlug('Product', $product->name, $id = 0);

        if(!$product->save())
            return $this->getResponse(500, 'Something went wrong.');
        
        $this->activityLog($product,'test-user', $request);

        return $this->getResponse(201, 'Product has been created', $product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id, ProductBuilder $productBuilder)
    {
        $product = Product::find($id);

        Log::info(101);
        Log::info($product);

        if(!$product) return $this->getResponse(404, 'Not Found');

        

        return $this->getResponse(200, 'Product Information', $productBuilder->transformProduct($product));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
