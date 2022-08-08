<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_detail';
    protected $primaryKey = 'orderdetail_id';

    protected $fillable = [
        'order_id',
        'image',
        'product_type',
        'product',
        'productdetail',
        'productdetail_id',
        'price',
        'number',
    ];

    /**
     * Get the articles for the category.
     * many to many relationships => article_category table
     */
    public function orderDetail()
    {
        return $this->belongsToMany(OrderDetail::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
