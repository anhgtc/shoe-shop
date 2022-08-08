<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected $folder = 'frontend.home.';
    /**
     * Display home page
     */
    public function index()
    {
        $categories = Category::query()->limit(3)->get();
        $menproducts = Product::query()->where('category_id', '=' ,'9') ->limit(4)->get();
        $womenproducts = Product::query()->where('category_id', '=' ,'10') ->limit(4)->get();
        $viewdata = [
            'categories' => $categories,
            'menproducts' => $menproducts,
            'womenproducts' => $womenproducts
        ];
        return view($this->folder . 'index', $viewdata);
    }

    /**
     * Display about page
     */
    public function about()
    {
        //
        return view($this->folder . 'about');
    }
}