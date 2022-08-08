<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $table = 'districts';
    protected $primarykey = 'id';

    protected $fillable = [
        'name',
        'gso_id',
        'province_id',
    ];

    /**
     * Get the articles for the category.
     * many to many relationships => article_category table
     */
    public function district()
    {
        return $this->belongsToMany(District::class);
    }

}
