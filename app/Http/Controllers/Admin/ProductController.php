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
    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm là bắt buộc',
            'name.string' => 'Tên sản phẩm phải là chuỗi',
            'name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự',
            'name.unique' => 'Tên sản phẩm đã tồn tại',
            'price.required' => 'Giá là bắt buộc',
            'price.numeric' => 'Giá phải là số',
            'price.min' => 'Giá không được nhỏ hơn 0',
            'stock.required' => 'Số lượng tồn kho là bắt buộc',
            'stock.integer' => 'Số lượng tồn kho phải là số nguyên',
            'stock.min' => 'Số lượng tồn kho không được nhỏ hơn 0',
            'status.required' => 'Trạng thái là bắt buộc',
            'status.in' => 'Trạng thái không hợp lệ',
            'category.required' => 'Danh mục là bắt buộc',
            'category.exists' => 'Danh mục không tồn tại',
            'brand_id.required' => 'Thương hiệu là bắt buộc',
            'brand_id.exists' => 'Thương hiệu không tồn tại',
            'discount.required' => 'Giảm giá là bắt buộc',
            'discount.numeric' => 'Giảm giá phải là số',
            'discount.min' => 'Giảm giá không được nhỏ hơn 0',
            'discount.max' => 'Giảm giá không được lớn hơn 100',
            'image_url.required' => 'Ảnh sản phẩm là bắt buộc',
            'image_url.image' => 'File phải là ảnh',
            'image_url.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif',
            'image_url.max' => 'Kích thước ảnh không được vượt quá 2MB',
            'description.required' => 'Mô tả là bắt buộc',
            'description.string' => 'Mô tả phải là chuỗi',
            'description.max' => 'Mô tả không được vượt quá 2000 ký tự',
        ];
    }

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
        $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:0,1',
            'category' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'discount' => 'required|numeric|min:0|max:100',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string|max:2000',
        ], $this->messages());
        

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
        $request->validate([
            'name' => "required|string|max:255|unique:products,name,$id",
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:1,0',
            'category' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'discount' => 'required|numeric|min:0|max:100',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string|max:2000',
        ], $this->messages());
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
