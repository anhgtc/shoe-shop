<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $table = 'status';
    protected $primaryKey = 'status_id';

    protected $fillable = [
        'name',
    ];

    /**
     * Get the articles for the category.
     * many to many relationships => article_category table
     */
    public function status()
    {
        return $this->belongsToMany(Status::class);
    }
}
