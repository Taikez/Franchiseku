<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function search(Request $request)
    {
        $searchValue = Education::where('title', 'like', '%'. $request->searchValue . '%')->get();
        return view('resultEducationContent', [
            'education_contents' => $searchValue
        ]);
    }
}
