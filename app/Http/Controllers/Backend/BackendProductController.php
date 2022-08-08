<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductDetail;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class BackendProductController extends Controller
{
    protected $folder = 'backend.product.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(request('length') ? request('length') : 5);

        $viewdata = [
            'products' => $products
        ];

        return view($this->folder . 'index', $viewdata);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $viewdata = [
            'categories' => $categories,
            'brands' => $brands
        ];

        // redict to create new form
        return view($this->folder . 'create', $viewdata);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Request validated
        $product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'content' => $request->content,
            'in_price' => $request->in_price,
            'price' => $request->price,
        ]);
        if ($request->hasFile('image_url')) {
            $file_name = 'image_product_' . $product->product_id;
            $ext = $request->file('image_url')->getClientOriginalExtension();
            $product->addMediaFromRequest('image_url')
                ->usingName($file_name)
                ->usingFileName($file_name . '.' . $ext)
                ->toMediaCollection('images_url');
        }
        $product = Product::orderBy('product_id', 'desc')->take(1)->get();
        foreach ($product as $pro) {
            $product_id = $pro->product_id;
        }
        Alert::success('Thêm mới sản phẩm', 'Thành công!');
        return redirect()->route('backend_product.edit', $product_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($product_id)
    {
        $product = Product::findOrFail($product_id);
        $categories = Category::all();
        $brands = Brand::all();
        $viewdata = [
            'product' => $product,
            'categories' => $categories,
            'brands' => $brands
        ];

        return view($this->folder . 'update', $viewdata);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($product_id)
    {
        $product = Product::findOrFail($product_id);
        $categories = Category::all();
        $brands = Brand::all();
        $productdetails = ProductDetail::where('product_id', $product->product_id)
            ->get();

        $viewdata = [
            'product' => $product,
            'productdetails' => $productdetails,
            'categories' => $categories,
            'brands' => $brands
        ];

        return view($this->folder . 'edit', $viewdata);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product_id)
    {
        $product = Product::findOrFail($product_id);
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->content = $request->content;
        $product->in_price = $request->in_price;
        $product->price = $request->price;
        if ($request->hasFile('image_url')) {
            $file_name = 'image_product_' . $product->product_id;
            $ext = $request->file('image_url')->getClientOriginalExtension();
            $product->addMediaFromRequest('image_url')
                ->usingName($file_name)
                ->usingFileName($file_name . '.' . $ext)
                ->toMediaCollection('images_url');
        }

        $product->save();
        Alert::success('Chỉnh sửa sản phẩm', 'Thành công!');
        return redirect()->route('backend_product.edit', $product_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id)
    {
        $cart = Cart::query()->where('product_id', '=', $product_id)->delete();
        $productdetails = ProductDetail::query()->where('product_id', '=', $product_id)->get();
        foreach ($productdetails as $productdetail) {
            $productdetail_id = $productdetail->productdetail_id;
            $orderdetails = DB::table('order_detail')->distinct()->where('productdetail_id', '=', $productdetail_id)->get('order_id');
            foreach ($orderdetails as $orderdetail) {
                $time = Carbon::now()->toDateTimeString();
                $order = Order::query()
                    ->where([
                        ['id', '=', $orderdetail->order_id],
                        ['status_id', '=', '1']
                    ])->first();
                $order_up = Order::query()
                    ->where([
                        ['id', '=', $orderdetail->order_id],
                        ['status_id', '=', 1]
                    ])->update(['status_id' => '5']);
                if ($order != null) {
                    $order_status = OrderStatus::query()
                        ->where([
                            ['order_id', '=', $order->id],
                            ['status_id', '=', 5]
                        ])
                        ->update(['time' => $time]);
                }
            }
            $orderdetail_up = OrderDetail::query()->where('productdetail_id', '=', $productdetail_id)->update(['productdetail_id' => null]);
        }
        $productdetails_del = ProductDetail::query()->where('product_id', '=', $product_id)->delete();
        $product = Product::query()->where('product_id', '=', $product_id)->delete();
        Alert::success('Xóa sản phẩm', 'Thành công!');
        return redirect()->back();
    }

    public function search(Request $request)
    {

        $search = $request->input('search_product');
        $products = Product::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->paginate(request('length') ? request('length') : 5);
        $viewdata = [
            'products' => $products
        ];

        return view($this->folder . 'index', $viewdata);
    }
}
