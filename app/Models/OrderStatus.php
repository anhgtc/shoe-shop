<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;
    protected $table = 'order_status';
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'status_id',
        'time',
    ];

    /**
     * Get the articles for the category.
     * many to many relationships => article_category table
     */
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
