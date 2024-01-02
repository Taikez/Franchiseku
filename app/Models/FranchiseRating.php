<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FranchiseRating extends Model
{
    use HasFactory;

    
    protected $table = 'franchise_rating';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function franchise()
    {
        return $this->belongsTo(Franchise::class, 'franchiseId');
    }

    public static function calculateAverageRating($franchiseId)
    {
        return static::where('franchiseId', $franchiseId)->avg('rating');
    }   
}
