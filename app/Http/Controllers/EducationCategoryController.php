<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EducationCategory;
use Illuminate\Support\Carbon;

class EducationCategoryController extends Controller
{
    //

    function AddEducationCategory (){
        return view('admin.education.add_education_category');

    } // end method


    function PostEducationCategory(Request $req){
        $req->validate([
            'educationCategory' => 'required',
        ],[
            'educationCategory.required' => 'Education Category is Required'
        ]);

        EducationCategory::insert([
            'educationCategory' => $req->educationCategory,
            'educationCategoryDesc' => $req->educationCategoryDesc,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Education Category Added Successfully!',
            'alert-type' => 'success',
        );

        return redirect()->route('all.education.category')->with($notification);
    } // end method

    function AllEducationCategory(){
        $educationCategories = EducationCategory::all();
        return view('admin.education.all_education_category', compact('educationCategories'));
    } // end method

    function DeleteEducationCategory($id){
        $category = EducationCategory::findOrFail($id);
        $categoryName = $category->educationCategory;

        $category->delete();


        $notification = array(
            'message' => $categoryName.' Deleted Successfully!',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }// end method
}
