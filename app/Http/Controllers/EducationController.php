<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EducationCategory;
use App\Models\Education;

class EducationController extends Controller
{
    public function index(Request $request)
    {
        $educationCategories = EducationCategory::all();

        // GET PARAMETER VALUES
        $categoryId = $request->input('category');
        $minPrice = $request->input('minPrice');
        $maxPrice = $request->input('maxPrice');
        $rating = $request->input('rating');

        // FILTER DATA
        $queryEducation = Education::query();

        if($categoryId !== null) 
            $queryEducation->where('categoryId', $categoryId);

        if($minPrice !== null)
            $queryEducation->where('price', '>=', $minPrice);

        if($maxPrice !== null)
            $queryEducation->where('price', '<=', $maxPrice);

        // if($rating !== null)
        //     $queryEducation->where('categoryId', $categoryId);

        // FETCH FILTERED DATA
        $educations = $queryEducation->get();

        return view('educationContent', compact('educationCategories', 'educations'));
    }

    public function search(Request $request)
    {
        $searchValue = Education::where('title', 'like', '%'. $request->searchValue . '%')->get();
        return view('resultEducationContent', [
            'education_contents' => $searchValue
        ]);
    }
}
