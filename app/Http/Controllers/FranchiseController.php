<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Franchise;

class FranchiseController extends Controller
{
    public function AllFranchise(){
       $allFranchise = Franchise::latest()->get();

        return view("admin.franchise.all_franchise", compact('allFranchise'));
    } // end method
}
