<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Brand extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'brand_id';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name'
    ];
    

    /**
     * Get the articles for the category.
     * many to many relationships => article_category table
     */
    public function brands()
    {
        return $this->belongsToMany(Brand::class);
    }
}
