<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class BackendCategoryController extends Controller
{
    protected $folder = 'backend.category.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(request('length') ? request('length') : 5);

        $viewdata = [
            'categories' => $categories
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
        return view($this->folder . 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Category::create([
            'name' => $request->name
        ]);
        Alert::success('Thêm mới danh mục sản phẩm', 'Thành công!');
        return redirect()->back();
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
    public function edit($category_id)
    {
        $category = Category::findOrFail($category_id);

        $viewdata = [
            'category' => $category
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
    public function update(Request $request, $category_id)
    {
        $category = Category::findOrFail($category_id);
        $category->name = $request->name;

        $category->save();
        Alert::success('Chỉnh sửa', 'Thành công!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($category_id)
    {
        $products = Product::query()->where('category_id', '=', $category_id)->get();
        foreach ($products as $product) {
            $product_id = $product->product_id;
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
        }
        $product_del = Product::query()->where('category_id', '=', $category_id)->delete();
        $category = Category::query()->where('category_id', '=', $category_id)->delete();
        Alert::success('Xóa danh mục sản phẩm', 'Thành công!');
        return redirect()->route('backend_category.index');
    }
    public function search(Request $request)
    {

        $search = $request->input('search_category');
        $categories = Category::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->paginate(request('length') ? request('length') : 5);
        $viewdata = [
            'categories' => $categories
        ];

        return view($this->folder . 'index', $viewdata);
    }
}
