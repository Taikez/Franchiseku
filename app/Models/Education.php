<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'education_contents';
    protected $guarded = [
        'id'
    ];

    public function educationCategory()
    {
         return $this->belongsTo('App\Models\EducationCategory', 'categoryId', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'userId', 'id');
    }
}
