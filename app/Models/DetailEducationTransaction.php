<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailEducationTransaction extends Model
{
    use HasFactory;
    
    protected $table = 'detail_education_transaction';
    protected $guarded = ['id'];

    public function educationContent()
    {
        return $this->belongsTo(EducationContent::class, 'educationContentId');
    }
}
