<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
// use Intervention\Image\Facades\Image;
use Image;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    public function allNews(){
        $allNews = News::all();

        return view('admin.news.all_news', compact('allNews'));
    }

    public function addNews(){
        $categories = NewsCategory::orderBy('newsCategory', 'ASC')->get();

        return view('admin.news.add_news', compact('categories'));
    }

    public function NewsDetail($id){
        $news = News::findOrFail($id);
        $categories = NewsCategory::all();
        
        $latestNews = News::latest()->limit(4)->get();

        return view('newsDetail', compact('news','categories', 'latestNews'));
    }

    public function PostNews(Request $req){
        if ($req->file('newsImage')) {
            $image = $req->file('newsImage');
            $name_gen = hexdec(uniqid()). '.' . $image->getClientOriginalExtension();


            //resize image

            //specify desired directory path
            $directory = 'upload/news/';

            $save_url = $directory . $name_gen;

            // Create the directory if it doesn't exist
            if (!File::isDirectory($directory)) {
                File::makeDirectory($directory, 0755, true);
            }

            Image::make($image)->resize(800,450)->save(public_path($directory . $name_gen));

            News::insert([
                'newsCategoryId' => $req->newsCategoryId,
                'newsTitle' => $req->newsTitle,
                'newsAuthor' => $req->newsAuthor,
                'newsContent' => $req->newsContent,
                'newsTags' => $req->newsTags,
                'created_at' => Carbon::now(),
                'newsImage' => $save_url,
            ]);
            
            $notification = array(
                'message' => 'News Added Successfully',
                'alert-type' => 'success',
            ); 
    
            return redirect()->route('all.news')->with($notification);

        }
    }



    public function News(){
        $categories = NewsCategory::all();
        $latestNews = News::latest()->limit(4)->get();
        return view('news',compact('categories','latestNews'));
    }
}
