<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
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

        $allNews = News::latest()->get();
        
        $latestNews = News::latest()->limit(4)->get();

        return view('newsDetail', compact('news','categories', 'latestNews','allNews'));
    }

    public function PostNews(Request $req){

         // Validation rules
        $rules = [
            'newsCategoryId' => 'required|string',
            'newsTitle' => 'required|string|max:255',
            'newsAuthor' => 'required|string|max:255',
            'newsContent' => 'required|string',
            'newsTags' => 'nullable|string|max:255', // Adjust as needed
            'newsImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust as needed
        ];

        // Custom error messages
        $messages = [
            'newsCategoryId.required' => 'The news category is required.',
            'newsCategoryId.string' => 'The news category must be an string.',
            'newsTitle.required' => 'The news title is required.',
            'newsTitle.string' => 'The news title must be a string.',
            'newsTitle.max' => 'The news title may not be greater than :max characters.',
            'newsAuthor.required' => 'The news author is required.',
            'newsAuthor.string' => 'The news author must be a string.',
            'newsAuthor.max' => 'The news author may not be greater than :max characters.',
            'newsContent.required' => 'The news content is required.',
            'newsContent.string' => 'The news content must be a string.',
            'newsTags.string' => 'The news tags must be a string.',
            'newsTags.max' => 'The news tags may not be greater than :max characters.',
            'newsImage.image' => 'The news image must be an image.',
            'newsImage.mimes' => 'The news image must be of type: :mimes.',
            'newsImage.max' => 'The news image may not be greater than :max kilobytes.',
        ];

        // Validate the request
        $req->validate($rules, $messages);

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
        $news = News::latest()->limit(5)->get();
        return view('news',compact('categories','latestNews','news'));
    }

    public function NewsByCategory($categoryId){
        $news = News::where('newsCategoryId', $categoryId)->latest()->limit(4)->get();
        $categories = NewsCategory::all();
        $latestNews = News::latest()->limit(4)->get();

        return view('news', compact('categories','latestNews','news'));
    }

    public function NewsByTags($tag){
        $news = News::where('newsTags','like','%'.$tag.'%')->latest()->limit(4)->get();
        $categories = NewsCategory::all();
        $latestNews = News::latest()->limit(4)->get();

        return view('news', compact('categories','latestNews','news'));
    }

    public function DeleteNews($id){
        $news = News::findOrFail($id);

        $news->delete();

        $notification = array(
            'message' => 'News Deleted Successfully!',
            'alert-type' => 'success',
            'showLoadingSpinner' => true,
        );

        return redirect()->back()->with($notification);
    }

    public function EditNews($id){
        $news = News::findOrFail($id);
        $categories = NewsCategory::orderBy('newsCategory', 'ASC')->get();

        return view('admin.news.edit_news', compact('news','categories'));
    }

    public function UpdateNews(Request $req){
        $newsId = $req->id;

        $news = News::findOrFail($newsId);

        //if user want to update image
    
        if($req->file('newsImage')){

            $file_path = public_path($news->newsImage); 
            if (file_exists($file_path)) {
                unlink($file_path);
            }

            $image = $req->file('newsImage');
            $name_gen = hexdec(uniqid()). '.' . $image->getClientOriginalExtension();

            $directory = 'upload/news/';
            $saveUrl = $directory . $name_gen;

            Image::make($image)->resize(800,450)->save(public_path($directory . $name_gen));

            $news->update([
                'newsCategoryId' => $req->newsCategoryId,
                'newsTitle' => $req->newsTitle,
                'newsAuthor' => $req->newsAuthor,
                'newsContent' => $req->newsContent,
                'newsTags' => $req->newsTags,
                'updated_at' => Carbon::now(),
                'newsImage' => $saveUrl,
            ]);

            $notification = array(
                'message' => 'News Updated With Image Successfully',
                'alert-type' => 'success',
            ); 

            return redirect()->route('all.news')->with($notification);
        }else{
            $news->update([
                'newsCategoryId' => $req->newsCategoryId,
                'newsTitle' => $req->newsTitle,
                'newsAuthor' => $req->newsAuthor,
                'newsContent' => $req->newsContent,
                'newsTags' => $req->newsTags,
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'News Updated Without Image Successfully',
                'alert-type' => 'success',
            ); 

            return redirect()->route('all.news')->with($notification);
        }

       

    }

}
