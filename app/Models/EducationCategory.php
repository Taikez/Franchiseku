<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationCategory extends Model
{
    use HasFactory;
    protected $table = 'education_categories';
    protected $guarded = [
        'id'
    ];

    public function education()
    {
        return $this->hasMany('App\Models\Education');
    }
}
