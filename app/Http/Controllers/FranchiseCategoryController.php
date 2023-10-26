<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FranchiseCategory;
use Illuminate\Support\Carbon;

class FranchiseCategoryController extends Controller
{
    public function AddFranchiseCategory(){
        return view('admin.franchise.add_franchise_category');
    } // end method 

    public function PostFranchiseCategory(Request $req){
        $req->validate([
            'franchiseCategory' => 'required',
        ],[
            'franchiseCategory.required' => 'Education Category is Required'
        ]);

        FranchiseCategory::insert([
            'franchiseCategory' => $req->franchiseCategory,
            'franchiseCategoryDesc' => $req->franchiseCategoryDesc,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Franchise Category Added Successfully!',
            'alert-type' => 'success',
        );

        return redirect()->route('all.franchise.category')->with($notification);
    } // end method 


    public function AllFranchiseCategory(){
        $franchiseCategories = FranchiseCategory::latest()->get();
        return view('admin.franchise.all_franchise_category', compact('franchiseCategories'));
    } // end method


    function DeleteFranchiseCategory($id){
        $category = FranchiseCategory::findOrFail($id);
        $categoryName = $category->educationCategory;

        $category->delete();


        $notification = array(
            'message' => $categoryName.' Deleted Successfully!',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }// end method
}
