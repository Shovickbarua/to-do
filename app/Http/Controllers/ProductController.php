<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Traits\CommonTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use CommonTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = Product::all();
            return $this->sendResponse([
                'data' => $products,
                'message' => 'Products retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return $this->sendError(['message' => $e->getMessage()], 500);
        }   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        try {
            $product = Product::create($request->all());
            return $this->sendResponse([
                'data' => $product,
                'message' => 'Product created successfully'
            ], 201);
        } catch (\Exception $e) {
            return $this->sendError(['message' => $e->getMessage()], 500);
        }   
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        try {
            return $this->sendResponse([
                'data' => $product,
                'message' => 'Product retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return $this->sendError(['message' => $e->getMessage()], 500);
        }   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        try {
            return $this->sendResponse([
                'data' => $product,
                'message' => 'Product retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return $this->sendError(['message' => $e->getMessage()], 500);
        }   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        try {
            $product->update($request->all());
            return $this->sendResponse([
                'data' => $product,
                'message' => 'Product updated successfully'
            ]);
        } catch (\Exception $e) {
            return $this->sendError(['message' => $e->getMessage()], 500);
        }   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return $this->sendResponse([
                'data' => $product,
                'message' => 'Product deleted successfully'
            ]);
        } catch (\Exception $e) {
            return $this->sendError(['message' => $e->getMessage()], 500);
        }   
    }
}
