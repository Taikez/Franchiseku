<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Education;
use App\Models\EducationContent;
use App\Models\EducationCategory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\TimeCode;

use Illuminate\Support\Facades\File;

class EducationController extends Controller
{
    //

    public function AllEducation(){
        $educations = EducationContent::all();

        return view('admin.education.all_education', compact('educations'));
    } // end method


    public function AddEducation(){
        $educationCategories = EducationCategory::orderBy('educationCategory', 'ASC')->get();

        return view('admin.education.add_education', compact('educationCategories'));
    } // end method

    public function storeVideo(Request $req){
 
        $video = $req->file('educationVideo');
        $name_gen_vid = hexdec(uniqid()). '.' . $video->getClientOriginalExtension();
        //resize image
        
        //specify desired directory path
        $directory = 'upload/education/';
        
        $save_url_vid = $directory . $name_gen_vid;

        dd($directory,$name_gen_vid,'public');
        //store video
        $video->storeAs($directory,$name_gen_vid,'public');
    }


    public function PostEducation(Request $req){
        $uploadedFiles = $req->file('educationVideo');
        
        // $this->storeVideo($req);
        // dd($req);

        $customMessages = [
            'educationTitle.required' => 'Education Title is Required!',
            'educationDesc.required' => 'Education Description is Required!',
            'educationShortDesc.required' => 'Education Short Description is Required!',
            'educationAuthor.required' => 'Education Author is Required!',
            'educationPrice.required' => 'Education Price is Required!',
            'educationPrice.integer' => 'Education Price must be an integer!',
            'educationCategory.required' => 'Education Category is Required!',
            // 'educationVideo.required' => 'Education Video is Required!',
            'educationVideo.mimes' => 'Education Video must be in one of the allowed formats (mp4, mov, avi, mkv, wmv).',
            'educationThumbnail.required' => 'Education Thumbnail is Required!',
            'educationThumbnail.image' => 'Education Thumbnail must be a valid image file.',
            'educationThumbnail.mimes' => 'Education Thumbnail must be in one of the allowed image formats (jpeg, png, jpg, gif).',
        ];
        
        $validatedData = $req->validate([
            'educationTitle' => 'required|string|max:255',
            'educationDesc' => 'required|string',
            'educationShortDesc' => 'required|string|max:255',
            'educationAuthor' => 'required|string|max:255',
            'educationCategory' => 'required|string|max:255',
            'educationPrice' => 'required|integer',
            'educationThumbnail' => 'required|image|mimes:jpeg,png,jpg,gif',
            'educationVideo' => 'required|mimes:mp4,mov,avi,mkv,wmv',
        ],$customMessages);

        //get category name
        $education = EducationCategory::findOrFail($validatedData['educationCategory']);
        
        
        $image = $req->file('educationThumbnail');
        $video = $req->file('educationVideo');
        $name_gen_img = hexdec(uniqid()). '.' . $image->getClientOriginalExtension();
        $name_gen_vid = hexdec(uniqid()). '.' . $video->getClientOriginalExtension();
        
        //resize image
        
        //specify desired directory path
        $directory = 'upload/education/';
        
        $save_url_img = $directory . $name_gen_img;
        $save_url_vid = $directory . $name_gen_vid;

            // Create the directory if it doesn't exist
        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory);
        }

        //store image
        Image::make($image)->resize(800,450)->save(public_path($directory . $name_gen_img));

        //store video
        $video->storeAs($directory,$name_gen_vid,'public');
        

        EducationContent::insert([
            'educationTitle' => $validatedData['educationTitle'],
            'educationCategory' => $education->educationCategory,
            'education_category_id' => $validatedData['educationCategory'],
            'educationShortDesc' => $validatedData['educationShortDesc'],
            'educationDesc' => $validatedData['educationDesc'],
            'educationAuthor' => $validatedData['educationAuthor'],
            'educationPrice' => $validatedData['educationPrice'],
            'educationVideo' => $save_url_vid,
            'educationThumbnail' => $save_url_img,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Education Added Successfully',
            'alert-type' => 'success',
        ); 

        return redirect()->route('all.education')->with($notification);
    } // end method

      public function index(Request $request)
    {
        $educationCategories = EducationCategory::all();

        // GET PARAMETER VALUES
        $categoryId = $request->input('category');
        $minPrice = $request->input('minPrice');
        $maxPrice = $request->input('maxPrice');
        $rating = $request->input('rating');

        // FILTER DATA
        $queryEducation = EducationContent::query();

        if($categoryId !== null) 
            $queryEducation->where('education_category_id', $categoryId);

        if($minPrice !== null)
            $queryEducation->where('educationPrice', '>=', $minPrice);

        if($maxPrice !== null)
            $queryEducation->where('educationPrice', '<=', $maxPrice);

        // if($rating !== null)
        //     $queryEducation->where('categoryId', $categoryId);

        // FETCH FILTERED DATA
        $educations = $queryEducation->get();

        return view('educationContent', compact('educationCategories', 'educations'));
    }

    public function search(Request $request)
    {
        $educationCategories = EducationCategory::all();
        $educations = EducationContent::where('educationTitle', 'like', '%'. $request->searchValue . '%')->get();
        
        return view('educationContent', compact('educationCategories', 'educations'));
    }

    public function detail($id)
    {
        $education = EducationContent::findOrFail($id);
        $videoPublicPath = EducationContent::where('id', $id)->pluck('educationVideo');
        $otherEducations = EducationContent::where('education_category_id', $education->education_category_id)->whereNot('id', $id)->limit(3)->get();

        // GET VIDEO DURATION
        $videoPath = public_path($videoPublicPath);
        $duration = shell_exec("ffprobe -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 '{$videoPath}'");
        $educationDuration = round(floatval($duration) / 60, 2);

        return view('educationDetail', compact('education','educationDuration', 'otherEducations'));
    }
}
