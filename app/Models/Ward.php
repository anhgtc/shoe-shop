<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;
    protected $table = 'wards';
    protected $primarykey = 'id';

    protected $fillable = [
        'name',
        'gso_id',
        'district_id',
    ];

    /**
     * Get the articles for the category.
     * many to many relationships => article_category table
     */
    public function ward()
    {
        return $this->belongsToMany(Ward::class);
    }

}
