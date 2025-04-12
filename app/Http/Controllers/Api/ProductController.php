<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


use App\Models\Product;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function index(){
        $products = Product::select('name', 'price')->get();
        return response()->json([
            'status' => 'success',
            'data' => $products,
        ]);
        
    }

    public function show($id){
        $product = Product::find($id);
        return response()->json([
            'status' => 'success',
            'data' => $product,
        ]);
    }

    public function add(Request $request){
        // validate
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'discount' => 'nullable|numeric|min:0|max:100',
                'stock' => 'required|integer|min:0',
                'category_id' => 'required|exists:categories,id',
                'brand_id' => 'nullable|exists:brands,id',
                'status' => 'required|in:active,inactive',
                'image_url' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
            ],422);
        }
        
        $imagePath = null;
        $image = $request->file('image_url');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = 'products/' . $imageName;
            $image->storeAs('products', $imageName, 'public');

        $slug = Str::slug($request->name);
        
        $data = [
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'status' => $request->status,
            'image_url' => $imagePath,
        ];

        $newProduct = Product::create($data);

        return response()->json([
            'status' => 'success',
            'data' => $newProduct,
        ],201);
    }

    public function update(Request $request, $id){
        

        $product = Product::find($id);
        if(!$product){
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found',
            ], 403);
        }
        

        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'discount' => 'nullable|numeric|min:0|max:100',
                'stock' => 'required|integer|min:0',
                'category_id' => 'required|exists:categories,id',
                'brand_id' => 'nullable|exists:brands,id',
                'status' => 'required|in:active,inactive',
                'image_url' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
            ],422);
        }
        

        // giữ lại đường dẫn ảnh cũ nếu có
        $imagePath = $product->image_url;

        
        if ($request->hasFile('image_url')) {

            // Kiểm tra và xóa ảnh cũ nếu tồn tại
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            $image = $request->file('image_url');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = 'products/' . $imageName;
            $image->storeAs('products', $imageName, 'public');
        
        }

        $slug = Str::slug($request->name);

        
        $data = [
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'status' => $request->status,
            'image_url' => $imagePath,
        ];

        

        $product->update($data);

        return response()->json([
            'status' => 'success',
            'data' => $product,
        ],200);
    }

    public function delete($id){
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found',
            ], 404);
        }

        $product->delete(); // <-- soft delete 

        return response()->json([
            'status' => 'success',
            'message' => 'Product soft deleted successfully',
        ]);
    }
}
