<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $listProduct = Product::paginate(10);
        return view('admin.products.index', compact('listProduct'));
    }

    public function addProduct()
    {
        $listBrands = Brand::all();
        $listCategories = Category::all();
        return view('admin.products.add', compact('listCategories', 'listBrands'));
    }

    public function handleAddProduct(Request $request)
    {
        $imagePath = null;
        if ($request->hasFile('image_url')) {
            try {
                $image = $request->file('image_url');

                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = 'products/' . $imageName;

                // Lưu file và kiểm tra kết quả - chỉ định rõ disk 'public'
                $result = $image->storeAs('products', $imageName, 'public');
                if (!$result) {
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

    public  function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $listBrands = Brand::all();
        $listCategories = Category::all();
        return view('admin.products.update', compact('product', 'listCategories', 'listBrands'));
    }

    public function postUpdateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $imagePath = $product->image_url; // Giữ nguyên đường dẫn ảnh cũ

        if ($request->hasFile('image_url')) {
            try {
                // Kiểm tra và xóa ảnh cũ nếu tồn tại
                if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }

                // Upload ảnh mới
                $image = $request->file('image_url');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = 'products/' . $imageName;

                // Lưu file ảnh mới vào disk 'public'
                $image->storeAs('products', $imageName, 'public');
                
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Lỗi khi upload ảnh: ' . $e->getMessage());
            }
        }

        try {
            // Cập nhật dữ liệu sản phẩm
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'discount' => $request->discount,
                'stock' => $request->stock,
                'status' => $request->status,
                'category_id' => $request->category,
                'image_url' => $imagePath, // Cập nhật đường dẫn ảnh mới
                'brand_id' => $request->brand_id,
                'description' => $request->description,
            ]);

            return redirect()->route('admin.products.index')->with('message', 'Sản phẩm đã được cập nhật!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi khi cập nhật sản phẩm: ' . $e->getMessage());
        }
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image_url) {
            $imagePath = public_path('storage/' . $product->image_url);
            if (file_exists($imagePath)) {
                unlink($imagePath); // Xóa file ảnh
            }
        }

        $product->delete(); // Thực hiện soft delete
        return redirect()->route('admin.products.index')->with('message', 'Sản phẩm đã được xóa.');
    }
}
