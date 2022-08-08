<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class ProductController extends Controller
{
    protected $folder = 'frontend.product.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        $categories = Category::query()->limit(3)->get();
        $allcategories = Category::all();
        $products = Product::paginate(request('length') ? request('length') : 9);
        $viewdata = [
            'categories' => $categories,
            'products' => $products,
            'brands' => $brands,
            'allcategories' => $allcategories
        ];
        return view($this->folder . 'index', $viewdata);
    }
    public function classify($category_id)
    {
        $brands = Brand::all();
        $categories = Category::query()->limit(3)->get();
        $allcategories = Category::all();
        $products = Product::where('category_id', $category_id)->paginate(9);
        $viewdata = [
            'categories' => $categories,
            'products' => $products,
            'brands' => $brands,
            'allcategories' => $allcategories
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($product_id)
    {
        $categories = Category::query()->limit(3)->get();
        $product = Product::findOrFail($product_id);
        // $brand_id = $product->brand_id;
        // $brand = DB::table('brands')->where('brand_id', '=' ,$brand_id)->get();
        $productdetails = DB::table('product_detail')->distinct()->where('product_id', '=', $product_id)->get('color');
        $similar_products = Product::inRandomOrder()->where('brand_id', '=', $product->brand_id)->limit(4)->get();
        $productdetail_1 = DB::table('product_detail')->where('product_id', '=', $product_id)->first();
        $viewdata = [
            'product' => $product,
            'productdetails' => $productdetails,
            // 'brand' => $brand,
            'productdetail_1' => $productdetail_1,
            'categories' => $categories,
            'similar_products' => $similar_products
        ];

        return view($this->folder . 'detail', $viewdata);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {

        $categories = Category::query()->limit(3)->get();
        $search = $request->input('search_product');
        $allcategories = Category::all();
        $brands = Brand::all();
        $products = Product::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->paginate(request('length') ? request('length') : 9);
        $viewdata = [
            'products' => $products,
            'categories' => $categories,
            'allcategories' => $allcategories,
            'brands' => $brands
        ];

        return view($this->folder . 'index', $viewdata);
    }
    public function number(Request $request)
    {
        if ($request->ajax()) {
            $productdetails = ProductDetail::query()
                ->where('productdetail_id', '=', $request->productdetail_id)->get();
            return response()->json($productdetails);
        }
    }

    public function size(Request $request)
    {
        if ($request->ajax()) {
            $productdetails = ProductDetail::query()
                ->where('product_id', '=', $request->product_id)
                ->where('color', '=', $request->productdetail_color)->get();
            return response()->json($productdetails);
        }
    }

    public function filter(Request $request)
    {
        $brands = Brand::all();
        $categories = Category::query()->limit(3)->get();
        $allcategories = Category::all();
        if ($request->myselection == 'moi')
            $products = Product::query()->where('brand_id', '=', $request->brand_id)->orderBy('product_id', 'desc')->paginate(request('length') ? request('length') : 9);
        elseif ($request->myselection == 'cu')
            $products = Product::query()->where('brand_id', '=', $request->brand_id)->paginate(request('length') ? request('length') : 9);
        elseif ($request->myselection == 'giam')
        {
            $products = Product::query()->where('brand_id', '=', $request->brand_id)->orderBy('price', 'desc')->paginate(request('length') ? request('length') : 9);
        }
        else
        {
            $products = Product::query()->where('brand_id', '=', $request->brand_id)->orderBy('price', 'asc')->paginate(request('length') ? request('length') : 9);
        }
        $viewdata = [
            'categories' => $categories,
            'products' => $products,
            'brands' => $brands,
            'allcategories' => $allcategories
        ];
        return view($this->folder . 'index', $viewdata);
    }

    public function selectSize()
    {
        $categories = Category::query()->limit(3)->get();
        $viewdata = [
            'categories' => $categories,
        ];
        return view($this->folder . 'size', $viewdata);
    }
}
