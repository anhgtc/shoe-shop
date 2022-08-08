<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'name',
        'status_id',
        'phone',
        'email',
        'address',
        'total_price',
        'order_date'
    ];

    /**
     * Get the articles for the category.
     * many to many relationships => article_category table
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
