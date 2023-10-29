<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationContent extends Model
{
    protected $table = 'education_contents';

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(EducationCategory::class, 'education_category_id');
    }
    
    public function rating()
    {
        return $this->hasMany(EducationContentRating::class);
    }

    use HasFactory;
}
