<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductDetail;
use App\Http\Requests\StoreProductDetailRequest;
use App\Models\Category;
use App\Models\Product;
use RealRashid\SweetAlert\Facades\Alert;

class BackendProductDetailController extends Controller
{
    protected $folder = 'backend.product.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $productdetail = ProductDetail::create([
            'product_id' => $request->product_id,
            'color' => $request->color,
            'size' => $request->size,
            'number' => $request->number,
        ]);
        return redirect()->route('backend_product.edit', $request->product_id);
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
    public function edit($productdetail_id)
    {
        $productdetail = ProductDetail::findOrFail($productdetail_id);

        $viewdata = [
            'productdetail' => $productdetail,
        ];

        return view($this->folder . 'edit_productdetail', $viewdata);
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
}
