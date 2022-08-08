<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $table = 'provinces';
    protected $primarykey = 'id';

    protected $fillable = [
        'name',
        'gso_id',
    ];

    /**
     * Get the articles for the category.
     * many to many relationships => article_category table
     */
    public function province()
    {
        return $this->belongsToMany(Province::class);
    }

}
