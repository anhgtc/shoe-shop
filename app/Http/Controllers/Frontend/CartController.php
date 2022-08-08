<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductDetail;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $folder = 'frontend.cart.';
    public function index()
    {
        $total_price = 0;
        if (Auth::check()) {
            $other_products = Product::inRandomOrder()->limit(4)->get();
            $carts = Cart::query()->where('user_id', '=', Auth::id())->get();
            foreach ($carts as $cart) {
                $total_price += $cart->product->price * $cart->number;
            }
            $categories = Category::query()->limit(3)->get();
            $viewdata = [
                'categories' => $categories,
                'carts' => $carts,
                'total_price' => $total_price,
                'other_products' => $other_products
            ];
            return view($this->folder . 'index', $viewdata);
        } else return redirect()->route('login');
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
    public function store(Request $request, $product_id)
    {
        if (Auth::user()) {
            if ($request->productdetail_size == null) Alert::warning('Bạn chưa chọn loại sản phẩm!');
            else {
                $productdetail = ProductDetail::query()->where('productdetail_id', '=', $request->productdetail_size)->first();
                if ($productdetail->number == 0) Alert::warning('Sản phẩm tạm hết hàng!');
                else {
                    $check = Cart::query()
                    ->where('productdetail_id', '=', $request->productdetail_size)
                    ->where('user_id','=',Auth::id())
                    ->first();
                    if ($check == null) {
                        $cart = Cart::create([
                            'user_id' => Auth::id(),
                            'product_id' => $product_id,
                            'productdetail_id' => $request->productdetail_size,
                            'number' => '1',
                        ]);
                    }
                    Alert::success('Thêm sản phẩm vào giỏ hàng', 'Thành công!');
                }
            }
            return redirect()->back();
        } else return redirect()->route('login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cart_id)
    {
        $cart_product = Cart::query()->where('cart_id', '=', $cart_id)->first();
        if ($cart_product->productdetail->number >= $request->number) {
            $cart = Cart::query()->where('cart_id', '=', $cart_id)->update(['number' => $request->number]);
            Alert::success('Cập nhật giỏ hàng', 'Thành công!');
        } else {
            Alert::error('Cập nhật giỏ hàng thất bại!', 'Số lượng sản phẩm trong kho không đủ');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);

        // Detach all relationships
        $cart->forceDelete();
        return redirect()->route('carts.index');
    }
}
