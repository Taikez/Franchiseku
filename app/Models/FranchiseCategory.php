<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class franchiseCategory extends Model
{
    use HasFactory;
    protected $table = 'franchise_categories';
    protected $guarded = [
        'id'
    ];

    public function franchise()
    {
        return $this->hasMany('App\Models\Franchise');
    }
   
}
