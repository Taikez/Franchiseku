<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationTransaction extends Model
{
    use HasFactory;
    
    protected $table = 'education_transaction';
    protected $guarded = ['id'];

    public function details()
    {
        return $this->hasMany(DetailEducationTransaction::class, 'transactionId');
    }
}
