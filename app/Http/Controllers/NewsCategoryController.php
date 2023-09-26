<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsCategory;
use Illuminate\Support\Carbon;

class NewsCategoryController extends Controller
{
    public function AllNewsCategory(){
        $newsCategories = NewsCategory::all();

        return view('admin.news.all_news_category', compact('newsCategories'));
    }

    //add news category
    public function AddNewsCategory(){ // ngarahin ke halaman add category doang
        return view('admin.news.add_news_category');
    }


    public function PostNewsCategory(Request $req){// store news category ke db
        $req->validate([
            'newsCategory' => 'required',
        ],[
            'newsCategory.required' => 'News Category is Required'
        ]);

        NewsCategory::insert([
            'newsCategory' => $req->newsCategory,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'News Category Added Successfully!',
            'alert-type' => 'success',
        );

        return redirect()->route('all.news.category')->with($notification);
    }


    public function DeleteNewsCategory($id){
        $category = NewsCategory::findOrFail($id);
        $categoryName = $category->newsCategory;

        $category->delete();


        $notification = array(
            'message' => $categoryName.' Deleted Successfully!',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }
}
