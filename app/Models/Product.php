<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use HasMediaTrait;

    protected $primaryKey = 'product_id';
    protected $fillable = [
        'name',
        'content',
        'in_price',
        'price',
        'category_id',
        'brand_id'
    ];

    /**
     * Get the articles for the category.
     * many to many relationships => article_category table
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('small')
            ->width(100)
            ->height(100);

        $this->addMediaConversion('thumb')
            ->width(200)
            ->height(200);

        $this->addMediaConversion('large')
            ->width(400)
            ->height(200);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
}
