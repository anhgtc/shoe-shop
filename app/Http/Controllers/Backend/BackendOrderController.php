<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\ProductDetail;
use App\Models\Status;
use RealRashid\SweetAlert\Facades\Alert;

class BackendOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $folder = 'backend.order.';
    public function index()
    {
        $orders = Order::paginate(request('length') ? request('length') : 5);
        $status = Status::all();
        $viewdata = [
            'status' => $status,
            'orders' => $orders,
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
    public function update(Request $request, $id)
    {
        $order_choose = Order::query()->where('id','=',$id)->first();
        if (($request->order_status == 2) && ($order_choose->status_id != 2)) {
            $order_count = OrderDetail::query()->where('order_id', '=', $id)->count();
            $order_check = OrderDetail::query()->where('order_id', '=', $id)->get();
            $check_number = 0;
            foreach ($order_check as $order) {
                $productdetail = ProductDetail::query()->where('productdetail_id', '=', $order->productdetail_id)->first();
                if ($order->number <= $productdetail->number) $check_number++;
                else break;
            }

            if ($order_count == $check_number) {
                foreach ($order_check as $order) {
                    $productdetail = ProductDetail::query()->where('productdetail_id', '=', $order->productdetail_id)->first();
                    $productdetail_up = ProductDetail::query()->where('productdetail_id', '=', $order->productdetail_id)->update(['number' => $productdetail->number - $order->number]);
                }
                $order = Order::query()->where('id', '=', $id)->update(['status_id' => $request->order_status]);
                $order_up = Order::query()->where('id', '=', $id)->get();
                foreach ($order_up as $order) {
                    $time = $order->updated_at;
                }
                $order_status = OrderStatus::query()
                    ->where('order_id', '=', $id)
                    ->where('status_id', '=', $request->order_status)
                    ->update(['time' => $time]);
                Alert::success('Cập nhật trạng thái đơn hàng', 'Thành công!');
            } else Alert::error('Cập nhật trạng thái đơn hàng thất bại', 'Số lượng trong kho hàng không đủ.');
        } else {
            $order = Order::query()->where('id', '=', $id)->update(['status_id' => $request->order_status]);
            $order_up = Order::query()->where('id', '=', $id)->get();
            foreach ($order_up as $order) {
                $time = $order->updated_at;
            }
            $order_status = OrderStatus::query()
                ->where('order_id', '=', $id)
                ->where('status_id', '=', $request->order_status)
                ->update(['time' => $time]);
            Alert::success('Cập nhật trạng thái đơn hàng', 'Thành công!');
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
        //
    }
    public function filter($status_id)
    {
        $orders = Order::query()
            ->where('status_id', '=', $status_id)
            ->paginate(request('length') ? request('length') : 5);
        $status = Status::all();
        $viewdata = [
            'status' => $status,
            'orders' => $orders,
        ];
        return view($this->folder . 'index', $viewdata);
    }
}
