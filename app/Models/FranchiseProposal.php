<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FranchiseProposal extends Model
{
    use HasFactory;

    protected $table = 'franchise_proposal';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'userId', 'id');
    }

    public function franchise()
    {
        return $this->belongsTo('App\Models\Franchise', 'franchise_id', 'id');
    }
}
