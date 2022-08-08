<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryOrder extends Model
{
    use HasFactory;
    protected $table = 'temporary_order';
    protected $fillable = [
        'order_id',
        'name',
        'phone',
        'email',
        'address',
    ];

    /**
     * Get the articles for the category.
     * many to many relationships => article_category table
     */
}
