<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'productdetail_id';
    protected $table= 'product_detail';

    protected $fillable = [
        'product_id',
        'color',
        'size',
        'number'
    ];

    /**
     * Get the articles for the category.
     * many to many relationships => article_category table
     */
    public function productDetail()
    {
        return $this->belongsToMany(ProductDetail::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
