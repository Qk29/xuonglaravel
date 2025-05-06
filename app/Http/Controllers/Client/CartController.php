<?php

namespace App\Http\Controllers\Client;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;



class CartController extends Controller
{

    public function index()
    {
        $userId = Auth::id();
        
        $cart = Cart::with('cartDetails.product')->where('user_id', $userId)->first();

        return view('client.carts.index', compact('cart'));
    }
    public function addToCart(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($productId);
        $userId = Auth::user()->id;
        if(!$userId) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem giỏ hàng.');
        }
        // Tìm hoặc tạo giỏ hàng cho người dùng hiện tại
        $cart = Cart::firstOrCreate([
            'user_id' => $userId,
        ]);

        // Kiểm tra sản phẩm đã có trong giỏ chưa
        $cartDetail = CartDetail::where('cart_id', $cart->id)
                                ->where('product_id', $product->id)
                                ->first();

        if ($cartDetail) {
            // Nếu có, tăng số lượng
            $cartDetail->quantity += $request->quantity;
            $cartDetail->save();
        } else {
            // Nếu chưa, thêm mới
            CartDetail::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng!');
    }
}
