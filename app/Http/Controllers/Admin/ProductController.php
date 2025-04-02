<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;  
use App\Models\Brand;  
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $listProduct = Product::paginate(10);
        return view('admin.products.index',compact('listProduct'));
    }

    public function addProduct(){
        $listBrands = Brand::all();
        $listCategories = Category::all();
        return view('admin.products.add',compact('listCategories','listBrands'));   
    }

    public function handleAddProduct(Request $request){
        $imagePath = null;
        if ($request->hasFile('image_url')) {
            try {
                $image = $request->file('image_url');

                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = 'products/' . $imageName;

                // Lưu file và kiểm tra kết quả - chỉ định rõ disk 'public'
                $result = $image->storeAs('products', $imageName, 'public');
                if(!$result) {
                    return redirect()->back()->with('error', 'Không thể lưu file ảnh');
                }
                
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Lỗi khi upload ảnh: ' . $e->getMessage());
            }
        }

        $slug = Str::slug($request->name, '-');
        $count = Product::where('slug', 'LIKE', "{$slug}%")->count();
        $finalSlug = $count ? "{$slug}-{$count}" : $slug;

        try {
            Product::create([
                'name' => $request->name,
                'slug' => $finalSlug, 
                'price' => $request->price,
                'discount' => $request->discount,
                'stock' => $request->stock,
                'status' => $request->status,
                'category_id' => $request->category,
                'brand_id' => $request->brand_id,
                'image_url' => $imagePath,
                'description' => $request->description,
            ]);

            return redirect()->route('admin.products.index')->with('message', 'Sản phẩm đã được thêm thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi khi thêm sản phẩm: ' . $e->getMessage());
        }
    }

    public  function editProduct($id){
        $product = Product::findOrFail($id);
        $listBrands = Brand::all();
        $listCategories = Category::all();
        return view('admin.products.update',compact('product','listCategories','listBrands'));
    }

    public function postUpdateProduct(Request $request, $id)
{
    $product = Product::findOrFail($id);

    
    

    // Cập nhật dữ liệu sản phẩm
    $product->update([
        'name' => $request->name,
        'price' => $request->price,
        'discount' => $request->discount,
        'stock' => $request->stock,
        'status' => $request->status,
        'category_id' => $request->category,
        'brand_id' => $request->brand_id,
        'description' => $request->description,
    ]);

    return redirect()->route('admin.products.index')->with('message', 'Sản phẩm đã được cập nhật!');
}

public function deleteProduct($id)
{
    $product = Product::findOrFail($id);
    $product->delete(); // Thực hiện soft delete
    return redirect()->route('admin.products.index')->with('message', 'Sản phẩm đã được xóa.');
}

}
