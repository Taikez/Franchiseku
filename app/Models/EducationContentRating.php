<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationContentRating extends Model
{
    use HasFactory;

    protected $table = 'education_content_rating';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function educationContent()
    {
        return $this->belongsTo(EducationContent::class, 'educationContentId');
    }

    public static function calculateAverageRating($educationContentId)
    {
        return static::where('educationContentId', $educationContentId)->avg('rating');
    }   
}
