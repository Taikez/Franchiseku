<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Education;
use App\Models\EducationContent;
use App\Models\EducationCategory;
use App\Models\EducationContentRating;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\TimeCode;
use Auth;
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
        $name_gen_vid = hexdec(uniqid()) . '.' . $video->getClientOriginalExtension();
        //resize image
        
        //specify desired directory path
        $directory = 'upload/education/';
        
        $save_url_vid = $directory . $name_gen_vid;

        dd($directory, $name_gen_vid, 'public');

        //store video
        EducationContent::updateOrCreate([
            'educationVideo' => $save_url_vid,
        ]);
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
        // $video->storeAs($directory,$name_gen_vid,'public');
        $video->move(public_path($directory), $name_gen_vid);
        
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

        if($rating !== null)
            $queryEducation->where('educationRating', $rating);

        // FETCH FILTERED DATA
        $educations = $queryEducation->limit(9)->get();

        return view('educationContent', compact('educationCategories', 'educations'));
    }

    public function userAllEducation(Request $request)
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

        if($rating !== null)
            $queryEducation->where('educationRating', $rating);

        // FETCH FILTERED DATA
        $educations = $queryEducation->paginate(9);

        return view('allEducationContent', compact('educationCategories', 'educations'));
    }

    public function search(Request $request)
    {
        $educationCategories = EducationCategory::all();
        $educations = EducationContent::where('educationTitle', 'like', '%'. $request->searchValue . '%')->paginate(9);
        
        return view('educationContent', compact('educationCategories', 'educations'));
    }

    public function detail($id)
    {
        // GET EDUCATION CONTENT
        $education = EducationContent::findOrFail($id);
        $videoPublicPath = EducationContent::where('id', $id)->pluck('educationVideo');
        $otherEducations = EducationContent::where('education_category_id', $education->education_category_id)->whereNot('id', $id)->limit(4)->get();
        $countingStars = $education->educationRating;

        // GET VIDEO DURATION
        $videoPath = public_path($videoPublicPath);
        $duration = shell_exec("ffprobe -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 '{$videoPath}'");
        $educationDuration = round(floatval($duration) / 60, 2);

        // GET RATINGS 
        $ratings = EducationContentRating::where(['educationContentId' => $id, 'rating' => 5])->limit(5)->get();

        return view('educationDetail', compact('education','educationDuration', 'otherEducations', 'countingStars', 'ratings'));
    }

    public function rateEducation(Request $request, $educationContentId)
    {
        if($request->isMethod('POST'))
        { 
            if(!Auth::check())
            {
                $message = "Login to rate this content!";
                return redirect()->back()->with('error', $message);
            }

            else
            {
                // VALIDATE FOR WHEN USER ALREADY RATED CONTENT
                $ratingCount = EducationContentRating::where(['userId' => Auth::user()->id, 'educationContentId' => $educationContentId])->count();
                if($ratingCount > 0)
                {
                    $message = "You have already rated this product!";
                    return redirect()->back()->with('error', $message);
                } 
                
                else
                {
                    // DO SOME VALIDATION HERE YEA
                    if($request->rating == null || $request->rating == "")
                    {
                        $message = "You haven't given this content a rating!";
                        return redirect()->back()->with('warning', $message);
                    }
                    
                    else if($request->ratingComment == null || $request->ratingComment == "")
                    {
                        $message = "Give the content a comment first!";
                        return redirect()->back()->with('warning', $message);
                    }

                    else
                    {
                        // STORE THE RATING
                        $rating = new EducationContentRating;
                        $rating->userId = Auth::user()->id;
                        $rating->educationContentId = $educationContentId;
                        $rating->rating = $request->rating;
                        $rating->comment = $request->ratingComment;
                        $rating->save();

                        // CALCULATE AVERAGE RATING AND STORE IT
                        $averageRating = EducationContentRating::calculateAverageRating($educationContentId);

                        $education = EducationContent::findOrFail($educationContentId);
                        $education->educationRating = $averageRating;
                        $education->save();

                        $message = 'Rating submitted successfully.';
                        return redirect()->back()->with('success', $message);
                    }
                }
            }
        }
    }

    public function purchaseEducation()
    {
        
    }
}
