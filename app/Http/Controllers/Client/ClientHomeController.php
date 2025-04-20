<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ClientHomeController extends Controller
{
    public function index()
    {
        $listProducts = Product::orderBy('created_at', 'desc')->paginate(10);
        return view('client.home',compact('listProducts'));
    }

    public function productDetail($id)
    {
        $product = Product::findOrFail($id);
        $relatedProducts = Product::where('category_id', $product->category_id)
                              ->where('id', '!=', $product->id)
                              ->take(5)
                              ->get();
        return view('client.productDetail', compact('product','relatedProducts'));
    }

    public function search(Request $request)
    {
        // Lấy giá trị tìm kiếm từ request
        $searchQuery = $request->input('search_query');

        // Thực hiện tìm kiếm trong bảng products theo tên
        $products = Product::where('name', 'like', '%' . $searchQuery . '%')->get();

        return view('client.search_results', compact('products', 'searchQuery'));
    }

}
