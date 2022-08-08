<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Validation\Rules;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Order;
use App\Models\Category;
use App\Models\Brand;
use App\Models\User;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BackendDashboardController extends Controller
{
    protected $folder = 'backend.dashboard.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all data
        $total_prices = Order::where([
            ['status_id', '>', 1],
            ['status_id', '<', 5]
        ])->sum('total_price');
        $total_products = Product::count();
        $total_orders = Order::count();
        $total_categories = Category::count();
        $total_brands = Brand::count();
        $total_users = User::count();

        // thong ke
        $start_date = "2022-07-25";
        $end_date = "2022-07-28";


        $interval = $this->dateDiffInDays($start_date, $end_date);
        for ($i = 0; $i <= $interval; $i++) {
            $t = Carbon::parse($start_date);
            $temp = $t->addDays($i)->toDateString();
            $total_price = Order::where([
                ['status_id', '>', 1],
                ['status_id', '<', 5],
                ['order_date', 'like', $temp]
            ])->sum('total_price');
            $total_order = Order::where([
                ['status_id', '>', 1],
                ['status_id', '<', 5],
                ['order_date', 'like', $temp]
            ])->count();
            $data_order[$temp] = $total_order;
            $data_price[$temp] = $total_price;
        }
        for ($j = 0; $j <= $interval; $j++) {
            $t = Carbon::parse($start_date);
            $temp = $t->addDays($j)->toDateString();
            $total_order = Order::where([
                ['status_id', '>', 1],
                ['status_id', '<', 5],
                ['order_date', 'like', $temp]
            ])->count();
            $data_order[$temp] = $total_order;
        }
        $label = array();
        $value_price = array();
        $value_order = array();
        foreach ($data_price as $key => $val) {
            array_push($label, $key);
            array_push($value_price, $val);
        }
        foreach ($data_order as $key => $val) {
            array_push($value_order, $val);
        }
        $chartjs_price = app()->chartjs
            ->name('barChart')
            ->type('bar')
            ->labels($label)
            ->datasets([
                [
                    "label" => "VNĐ",
                    'backgroundColor' => "rgba(255, 99, 132, 0.2)",
                    "borderColor" => "rgb(255, 99, 132)",
                    "borderWidth" => "1",
                    'data' => $value_price
                ],
            ])
            ->options([]);
        $chartjs_order = app()->chartjs
            ->name('lineChart')
            ->type('line')
            ->labels($label)
            ->datasets([
                [
                    "label" => "Đơn hàng",
                    'backgroundColor' => "rgba(54, 162, 235, 0.2)",
                    "borderColor" => "rgb(54, 162, 235)",
                    "borderWidth" => "1",
                    'data' => $value_order
                ],
            ])
            ->options([]);
        $chartjs_product = app()->chartjs
            ->name('lineChart')
            ->type('line')
            ->labels($label)
            ->datasets([
                [
                    "label" => "Đơn hàng",
                    'backgroundColor' => "rgba(54, 162, 235, 0.2)",
                    "borderColor" => "rgb(54, 162, 235)",
                    "borderWidth" => "1",
                    'data' => $value_order
                ],
            ])
            ->options([]);
        $viewdata = [
            'total_products' => $total_products,
            'total_orders' => $total_orders,
            'total_categories' => $total_categories,
            'total_brands' => $total_brands,
            'total_users' => $total_users,
            'total_prices' => $total_prices,
            'chartjs_price' => $chartjs_price,
            'chartjs_order' => $chartjs_order,
            'chartjs_product' => $chartjs_product
        ];
        return view($this->folder . 'index', $viewdata);
    }

    public function filter(Request $request)
    {
        // get all data
        $total_prices = Order::where([
            ['status_id', '>', 1],
            ['status_id', '<', 5]
        ])->sum('total_price');
        $total_products = Product::count();
        $total_orders = Order::count();
        $total_categories = Category::count();
        $total_brands = Brand::count();
        $total_users = User::count();

        // thong ke
        $start_date = $request->start_date;
        $end_date = $request->end_date;


        $interval = $this->dateDiffInDays($start_date, $end_date);
        for ($i = 0; $i <= $interval; $i++) {
            $t = Carbon::parse($start_date);
            $temp = $t->addDays($i)->toDateString();
            $total_price = Order::where([
                ['status_id', '>', 1],
                ['status_id', '<', 5],
                ['order_date', 'like', $temp]
            ])->sum('total_price');
            $total_order = Order::where([
                ['status_id', '>', 1],
                ['status_id', '<', 5],
                ['order_date', 'like', $temp]
            ])->count();
            $data_order[$temp] = $total_order;
            $data_price[$temp] = $total_price;
        }
        $label = array();
        $value_price = array();
        $value_order = array();
        foreach ($data_price as $key => $val) {
            array_push($label, $key);
            array_push($value_price, $val);
        }
        foreach ($data_order as $key => $val) {
            array_push($value_order, $val);
        }
        $start = '';
        foreach ($data_order as $key => $val) {
            if ($val > 0) {
                $start = $key;
                break;
            }
        }
        $end = '';
        foreach ($data_order as $key => $val) {
            if ($val > 0) {
                $end = $key;
            }
        }
        $order_start = Order::query()->where([
            ['status_id', '>', 1],
            ['status_id', '<', 5],
            ['order_date', 'like', $start]
        ])->get();
        $order_s = '';
        foreach ($order_start as $order) {
            $order_s = $order->id;
            break;
        }

        $order_end = Order::query()->where([
            ['status_id', '>', 1],
            ['status_id', '<', 5],
            ['order_date', 'like', $end]
        ])->get();
        $order_e = '';
        foreach ($order_end as $order) {
            $order_e = $order->id;
        }
        $productdetails = DB::table('order_detail')->distinct()->where('order_id', '>=', $order_s)->where('order_id', '<=', $order_e)->get('product_type');
        foreach ($productdetails as $productdetail) {
            $product_type = $productdetail->product_type;
            $productdetail_sum = OrderDetail::where([
                ['order_id', '>=', $order_s],
                ['order_id', '<=', $order_e],
                ['product_type', '=', $product_type],
            ])->sum('number');
            $data_product[$product_type] = $productdetail_sum;
        }
        $type = array();
        $value_product = array();
        if (!empty($data_product)) {
            arsort($data_product);

            $d = 0;
            foreach ($data_product as $key => $val) {
                array_push($type, $key);
                array_push($value_product, $val);
                $d++;
                if ($d >= 5) break;
            }
        }
        $chartjs_price = app()->chartjs
            ->name('barChart')
            ->type('bar')
            ->labels($label)
            ->datasets([
                [
                    "label" => "VNĐ",
                    'backgroundColor' => "rgba(255, 99, 132, 0.2)",
                    "borderColor" => "rgb(255, 99, 132)",
                    "borderWidth" => "1",
                    'data' => $value_price
                ],
            ])
            ->options([]);
        $chartjs_order = app()->chartjs
            ->name('lineChart')
            ->type('line')
            ->labels($label)
            ->datasets([
                [
                    "label" => "Đơn hàng",
                    'backgroundColor' => "rgba(54, 162, 235, 0.2)",
                    "borderColor" => "rgb(54, 162, 235)",
                    "borderWidth" => "1",
                    'data' => $value_order
                ],
            ])
            ->options([]);
        $chartjs_product = app()->chartjs
            ->name('polarAreaChart')
            ->type('polarArea')
            ->labels($type)
            ->datasets([
                [
                    "label" => "Sản phẩm",
                    'backgroundColor' => ["rgb(255, 99, 132)", "rgb(54, 162, 235)", "rgb(255, 205, 86)", "rgb(75, 192, 192)", "rgb(153, 102, 255)"],
                    "borderColor" => ["rgb(255, 99, 132)", "rgb(54, 162, 235)", "rgb(255, 205, 86)", "rgb(75, 192, 192)", "rgb(153, 102, 255)"],
                    "borderWidth" => "1",
                    'data' => $value_product
                ],
            ])
            ->options([]);
        $viewdata = [
            'total_products' => $total_products,
            'total_orders' => $total_orders,
            'total_categories' => $total_categories,
            'total_brands' => $total_brands,
            'total_users' => $total_users,
            'total_prices' => $total_prices,
            'chartjs_price' => $chartjs_price,
            'chartjs_order' => $chartjs_order,
            'chartjs_product' => $chartjs_product,
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    function dateDiffInDays($date1, $date2)
    {
        // Calculating the difference in timestamps
        $diff = strtotime($date2) - strtotime($date1);

        // 1 day = 24 hours
        // 24 * 60 * 60 = 86400 seconds
        return abs($diff / 86400);
    }
}
