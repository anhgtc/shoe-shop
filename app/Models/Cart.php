<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart';
    protected $primaryKey = 'cart_id';

    protected $fillable = [
        'user_id',
        'product_id',
        'productdetail_id',
        'number',
    ];

    /**
     * Get the articles for the category.
     * many to many relationships => article_category table
     */
    public function Cart()
    {
        return $this->belongsToMany(Cart::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function productdetail()
    {
        return $this->belongsTo(ProductDetail::class, 'productdetail_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
