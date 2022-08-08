<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Province;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Ward;
use App\Models\OrderStatus;
use App\Models\Status;
use App\Models\TemporaryOrder;
use App\Models\ProductDetail;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    protected $folder = 'frontend.order.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::query()->limit(3)->get();
        $orders = Order::query()
            ->where('user_id', '=', Auth::id())
            ->paginate(request('length') ? request('length') : 5);
        $status = Status::all();
        $viewdata = [
            'status' => $status,
            'orders' => $orders,
            'categories' => $categories,
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
        $total_price = 0;
        $provinces = Province::all();
        $districts = District::all();
        $categories = Category::query()->limit(3)->get();
        $carts = Cart::query()->where('user_id', '=', Auth::id())->get();
        foreach ($carts as $cart) {
            $total_price += $cart->product->price * $cart->number;
        }
        $viewdata = [
            'categories' => $categories,
            'carts' => $carts,
            'provinces' => $provinces,
            'districts' => $districts,
            'total_price' => $total_price
        ];
        if ( $total_price == 0)
        {
            Alert::warning('Giỏ hàng đang trống');
            return redirect()->back();
        } 
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
        $carts = Cart::query()->where('user_id', '=', Auth::id())->get();
        $cart_number = Cart::query()->where('user_id', '=', Auth::id())->count();
        $count_number = 0;
        foreach ($carts as $cart) {
            if ($cart->number <= $cart->productdetail->number) $count_number++;
            else break;
        }
        if ($count_number == $cart_number) {
            if ($request->payment_method == "cod") {
                return $this->cod($request);
            } else {
                return $this->vnpay($request);
            }
        } else {
            Alert::error('Đặt hàng thất bại!', 'Số lượng sản phẩm trong kho không đủ!');
            return redirect()->back();
        }
    }
    public function cod(Request $request)
    {
        $carts = Cart::query()->where('user_id', '=', Auth::id())->get();
        $total_price = 0;
        $carbon = Carbon::now()->toDateString();
        $ward = Ward::query()->where('id', '=', $request->ward)->first();
        $district = District::query()->where('id', '=', $request->district)->first();
        $province = Province::query()->where('id', '=', $request->province)->first();
        foreach ($carts as $cart) {
            $total_price += $cart->product->price * $cart->number;
        }
        $order = Order::create([
            'order_id' => (string) Str::orderedUuid(),
            'user_id' => Auth::id(),
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address . ', ' . $ward->name . ', ' . $district->name . ', ' . $province->name,
            'total_price' => $total_price,
            'status_id' => '1',
            'order_date' => $carbon
        ]);

        $order_last = Order::orderBy('id', 'desc')->take(1)->get();
        foreach ($order_last as $order_l) {
            $id = $order_l->id;
            $order_time = $order_l->created_at;
        }
        foreach ($carts as $cart) {
            $productdetail_id = $cart->productdetail->productdetail_id;
            $orderdetail = OrderDetail::create([
                'order_id' => $id,
                'image' => $cart->product->getFirstMediaUrl('images_url', 'small'),
                'product_type' => $cart->product->name . ', Color: ' . $cart->productdetail->color . ', Size: ' . $cart->productdetail->size,
                'product' => $cart->product->name,
                'productdetail' => 'Color: ' . $cart->productdetail->color . ', Size: ' . $cart->productdetail->size,
                'productdetail_id' => $productdetail_id,
                'price' => $cart->product->price,
                'number' => $cart->number
            ]);
        }
        $orderstatus = OrderStatus::create([
            'order_id' => $id,
            'status_id' => '1',
            'time' => $order_time,
        ]);
        for ($i = 2; $i <= 5; $i++) {
            $orderstatus = OrderStatus::create([
                'order_id' => $id,
                'status_id' => $i,
                'time' => null,
            ]);
        }
        $carts = Cart::query()->where('user_id', '=', Auth::id())->delete();
        Alert::success('Đặt hàng', 'Thành công!');
        // if()
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($order_id)
    {
        $categories = Category::query()->limit(3)->get();
        $order = Order::query()
            ->where('id', '=', $order_id)
            ->first();
        $orderdetails = OrderDetail::query()
            ->where('order_id', '=', $order_id)
            ->get();
        $orderstatus = OrderStatus::query()
            ->where('order_id', '=', $order_id)
            ->get();
        $viewdata = [
            'orderdetails' => $orderdetails,
            'categories' => $categories,
            'orderstatus' => $orderstatus,
            'order' => $order
        ];

        return view($this->folder . 'show', $viewdata);
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
    public function district(Request $request)
    {
        if ($request->ajax()) {
            $districts = District::query()
                ->where('province_id', '=', $request->province_id)->get();
            return response()->json($districts);
        }
    }
    public function ward(Request $request)
    {
        if ($request->ajax()) {
            $wards = Ward::query()
                ->where('district_id', '=', $request->district_id)->get();
            return response()->json($wards);
        }
    }

    public function vnpay(Request $request)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/vnpay-success";
        $vnp_TmnCode = "WAPHOR8J"; //Mã website tại VNPAY 
        $vnp_HashSecret = "UHJUQXDHTPJCYRKWNDFEYAFNRTCHCOPU"; //Chuỗi bí mật
        $total_price = 0;
        $carts = Cart::query()->where('user_id', '=', Auth::id())->get();
        $ward = Ward::query()->where('id', '=', $request->ward)->first();
        $district = District::query()->where('id', '=', $request->district)->first();
        $province = Province::query()->where('id', '=', $request->province)->first();
        foreach ($carts as $cart) {
            $total_price += $cart->product->price * $cart->number;
        }
        $vnp_TxnRef = (string) Str::orderedUuid();
        $vnp_OrderInfo = 'Thanh toan don hang';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $total_price * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $vnp_Bill_Mobile = $request->phone;
        $vnp_Bill_Address = $request->address;
        $vnp_Bill_City = $province->name;
        $vnp_Bill_Country = $district->name;
        $vnp_Bill_State = $ward->name;
        $vnp_Bill_Email = $request->email;
        $vnp_Bill_LastName = $request->name;
        $temporary_order = TemporaryOrder::create([
            'order_id' => $vnp_TxnRef,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address . ', ' . $ward->name . ', ' . $district->name . ', ' . $province->name,
        ]);
        //Add Params of 2.0.1 Version
        // $vnp_ExpireDate = $_POST['txtexpire'];
        //Billing
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_Bill_Mobile" => $vnp_Bill_Mobile,
            "vnp_Bill_Email" => $vnp_Bill_Email,
            "vnp_Bill_LastName" => $vnp_Bill_LastName,
            "vnp_Bill_Address" => $vnp_Bill_Address,
            "vnp_Bill_City" => $vnp_Bill_City,
            "vnp_Bill_Country" => $vnp_Bill_Country,
        );
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        header('Location: ' . $vnp_Url);

        die();
    }

    public function vnpaySuccess(Request $request)
    {
        $vnp_ResponseCode = $request->query('vnp_ResponseCode');
        $vnp_Amount = $request->query('vnp_Amount') / 100;
        $vnp_TxnRef = $request->query('vnp_TxnRef');
        $temporary_order = TemporaryOrder::query()->where('order_id', '=', $vnp_TxnRef)->first();
        if ($vnp_ResponseCode == '00') {
            $total_price = 0;
            $carbon = Carbon::now()->toDateString();
            $carts = Cart::query()->where('user_id', '=', Auth::id())->get();
            $ward = Ward::query()->where('id', '=', $request->ward)->first();
            $district = District::query()->where('id', '=', $request->district)->first();
            $province = Province::query()->where('id', '=', $request->province)->first();
            foreach ($carts as $cart) {
                $total_price += $cart->product->price * $cart->number;
            }
            $order = Order::create([
                'order_id' => $temporary_order->order_id,
                'user_id' => Auth::id(),
                'name' => $temporary_order->name,
                'phone' => $temporary_order->phone,
                'email' => $temporary_order->email,
                'address' => $temporary_order->address,
                'total_price' => $total_price,
                'status_id' => '2',
                'order_date' => $carbon
            ]);

            $order_last = Order::orderBy('id', 'desc')->take(1)->get();
            foreach ($order_last as $order_l) {
                $id = $order_l->id;
                $order_time = $order_l->created_at;
            }
            foreach ($carts as $cart) {
                $productdetail_id = $cart->productdetail_id;
                $orderdetail = OrderDetail::create([
                    'order_id' => $id,
                    'image' => $cart->product->getFirstMediaUrl('images_url', 'small'),
                    'product_type' => $cart->product->name . ', Color: ' . $cart->productdetail->color . ', Size: ' . $cart->productdetail->size,
                    'product' => $cart->product->name,
                    'productdetail' => 'Color: ' . $cart->productdetail->color . ', Size: ' . $cart->productdetail->size,
                    'productdetail_id' => $productdetail_id,
                    'price' => $cart->product->price,
                    'number' => $cart->number
                ]);
                $productdetail = ProductDetail::query()->where('productdetail_id', '=', $productdetail_id)->first();
                $productdetail_up = ProductDetail::query()->where('productdetail_id', '=', $productdetail_id)->update(['number' => $productdetail->number - $cart->number]);
            }

            $orderstatus = OrderStatus::create([
                'order_id' => $id,
                'status_id' => '2',
                'time' => $order_time,
            ]);
            for ($i = 3; $i < 5; $i++) {
                $orderstatus = OrderStatus::create([
                    'order_id' => $id,
                    'status_id' => $i,
                    'time' => null,
                ]);
            }
            $cart_del = Cart::query()->where('user_id', '=', Auth::id())->delete();
            Alert::success('Đặt hàng', 'Thành công!');
        }
        return redirect()->route('home');
    }
    public function filter($status_id)
    {
        $categories = Category::query()->limit(3)->get();
        $orders = Order::query()
            ->where('user_id', '=', Auth::id())
            ->where('status_id', '=', $status_id)
            ->paginate(request('length') ? request('length') : 5);
        $status = Status::all();
        $viewdata = [
            'status' => $status,
            'orders' => $orders,
            'categories' => $categories,
        ];
        return view($this->folder . 'index', $viewdata);
    }
}
