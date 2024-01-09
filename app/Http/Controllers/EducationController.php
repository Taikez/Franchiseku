<?php

namespace App\Http\Controllers;

use App\Models\EducationTransaction;
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
    public function AllEducation()
    {
        $educations = EducationContent::all();

        return view('admin.education.all_education', compact('educations'));
    } // end method

    public function AddEducation()
    {
        $educationCategories = EducationCategory::orderBy('educationCategory','ASC')->get();

        return view('admin.education.add_education',compact('educationCategories'));
    } // end method

    public function storeVideo(Request $req)
    {
        $video = $req->file('educationVideo');
        $name_gen_vid =
            hexdec(uniqid()) . '.' . $video->getClientOriginalExtension();
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

    public function PostEducation(Request $req)
    {
        $uploadedFiles = $req->file('educationVideo');

        // $this->storeVideo($req);
        // dd($req);

        $customMessages = [
            'educationTitle.required' => 'Education Title is Required!',
            'educationDesc.required' => 'Education Description is Required!',
            'educationShortDesc.required' =>
                'Education Short Description is Required!',
            'educationAuthor.required' => 'Education Author is Required!',
            'educationPrice.required' => 'Education Price is Required!',
            'educationPrice.integer' => 'Education Price must be an integer!',
            'educationCategory.required' => 'Education Category is Required!',
            // 'educationVideo.required' => 'Education Video is Required!',
            'educationVideo.mimes' =>
                'Education Video must be in one of the allowed formats (mp4, mov, avi, mkv, wmv).',
            'educationThumbnail.required' => 'Education Thumbnail is Required!',
            'educationThumbnail.image' =>
                'Education Thumbnail must be a valid image file.',
            'educationThumbnail.mimes' =>
                'Education Thumbnail must be in one of the allowed image formats (jpeg, png, jpg, gif).',
        ];

        $validatedData = $req->validate(
            [
                'educationTitle' => 'required|string|max:255',
                'educationDesc' => 'required|string',
                'educationShortDesc' => 'required|string|max:255',
                'educationAuthor' => 'required|string|max:255',
                'educationCategory' => 'required|string|max:255',
                'educationPrice' => 'required|integer',
                'educationThumbnail' => 'required|image|mimes:jpeg,png,jpg,gif',
                'educationVideo' => 'required|mimes:mp4,mov,avi,mkv,wmv',
            ],
            $customMessages
        );

        //get category name
        $education = EducationCategory::findOrFail(
            $validatedData['educationCategory']
        );

        $image = $req->file('educationThumbnail');
        $video = $req->file('educationVideo');
        $name_gen_img =
            hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $name_gen_vid =
            hexdec(uniqid()) . '.' . $video->getClientOriginalExtension();

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
        Image::make($image)
            ->resize(800, 450)
            ->save(public_path($directory . $name_gen_img));

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

        $notification = [
            'message' => 'Education Added Successfully',
            'alert-type' => 'success',
        ];

        return redirect()
            ->route('all.education')
            ->with($notification);
    } // end method

    public function index(Request $request)
    {
        $educationCategories = EducationCategory::all();
        $educations = EducationContent::all()->take(9);
        
        return view(
            'educationContent',
            compact('educationCategories', 'educations')
        );
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

        if ($categoryId !== null) {
            $queryEducation->where('education_category_id', $categoryId);
        }

        if ($minPrice !== null) {
            $queryEducation->where('educationPrice', '>=', $minPrice);
        }

        if ($maxPrice !== null) {
            $queryEducation->where('educationPrice', '<=', $maxPrice);
        }

        if ($rating !== null) {
            $queryEducation->where('educationRating', $rating);
        }

        // FETCH FILTERED DATA
        $educations = $queryEducation->paginate(12);

        return view(
            'allEducationContent',
            compact('educationCategories', 'educations')
        );
    }

    public function search(Request $request)
    {
        $educationCategories = EducationCategory::all();
        $educations = EducationContent::where(
            'educationTitle',
            'like',
            '%' . $request->searchValue . '%'
        )->paginate(9);

        return view(
            'educationContent',
            compact('educationCategories', 'educations')
        );
    }

    public function detail($id)
    {
        // GET EDUCATION CONTENT
        $education = EducationContent::findOrFail($id);
        $videoPublicPath = EducationContent::where('id', $id)->pluck('educationVideo');
        $otherEducations = EducationContent::where('education_category_id', $education->education_category_id)->whereNot('id', $id)->limit(4)->get();
        $averageRating = $education->educationRating;
        $countingStars = floor($averageRating);

        // GET VIDEO DURATION
        $videoPath = public_path($videoPublicPath[0]);
        $getID3 = new \getID3;
        $file = $getID3->analyze($videoPath);
        $duration_seconds = $file['playtime_seconds'];
        $educationDuration = round(floatval($duration_seconds) / 60, 1);

        // GET RATINGS
        $ratings = EducationContentRating::where(['educationContentId' => $id,'rating' => 5,])->limit(5)->get();

        //GET USER
        $user = Auth::user();

        // GET TRANSACTION COUNT
        $transactionCount = EducationTransaction::where(['education_id'=>$education->id, 'transaction_status'=>'settlement'])->get()->count();

        //GET USER TRANSACTION
        if (!Auth::check()) {
            $transaction = null;
            $snapToken = null;
            $transactionStatus = null;
        } else {
            $transaction = EducationTransaction::where(['userId'=> $user->id,'education_id'=>$education->id])->get();
            $buttonMessage = '';

            //GET SNAP TOKEN
            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = false;

            $params = [
                'transaction_details' => [
                    'order_id' => rand(),
                    'gross_amount' => $education->educationPrice,
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'last_name' => '',
                    'email' => $user->email,
                    'phone' => $user->phoneNumber,
                ],
                'item_details' => [
                    [
                        'id' => 'a1',
                        'price' => $education->educationPrice,
                        'quantity' => 1,
                        'name' => $education->educationTitle,
                    ],
                ],
            ];

            if($transaction->isEmpty()){
                $transactionStatus = false;
                $snapToken = \Midtrans\Snap::getSnapToken($params);
                $buttonMessage = 'Purchase Content';
                
            }else{
                if($transaction[$transaction->count()-1]->transaction_status == 'settlement'){
                    $transactionStatus = true;
                } else if($transaction[$transaction->count()-1]->transaction_status == 'pending') {
                    $transactionStatus = false;
                } else {
                    $transactionStatus = false;
                }
                $snapToken = $transaction[0]->snap_token;
            }

            //get transaction status
        }

        return view('educationDetail',
            compact(
                'education',
                'educationDuration',
                'otherEducations',
                'averageRating',
                'countingStars',
                'ratings',
                'snapToken',
                'transaction',
                'transactionStatus',
                'transactionCount',
            )
        );
    }

    public function rateEducation(Request $request, $educationContentId)
    {
        if ($request->isMethod('POST')) {
            if (!Auth::check()) {
                $message = "Login to rate this content!";
                return redirect('login')->with('error', $message);
            } else {
                // VALIDATE FOR WHEN USER ALREADY RATED CONTENT
                $ratingCount = EducationContentRating::where([
                    'userId' => Auth::user()->id,
                    'educationContentId' => $educationContentId,
                ])->count();
                if ($ratingCount > 0) {
                    $message = "You have already rated this product!";
                    return redirect()->back()->with('error', $message);
                } else {
                    // DO SOME VALIDATION HERE YEA
                    if ($request->rating == null || $request->rating == "") {
                        $message = "You haven't given this content a rating!";
                        return redirect()->back()->with('error', $message);
                    } elseif (
                        $request->ratingComment == null ||
                        $request->ratingComment == ""
                    ) {
                        $message = "Give the content a comment first!";
                        return redirect()->back()->with('error', $message);
                    } else {
                        // STORE THE RATING
                        $rating = new EducationContentRating();
                        $rating->userId = Auth::user()->id;
                        $rating->educationContentId = $educationContentId;
                        $rating->rating = $request->rating;
                        $rating->comment = $request->ratingComment;
                        $rating->save();

                        // CALCULATE AVERAGE RATING AND STORE IT
                        $averageRating = EducationContentRating::calculateAverageRating(
                            $educationContentId
                        );

                        $education = EducationContent::findOrFail(
                            $educationContentId
                        );
                        $education->educationRating = $averageRating;
                        $education->save();

                        $message = 'Rating submitted successfully.';
                        return redirect()->back()->with('success', $message);
                    }
                }
            }
        }
    }

    public function historyEducation(Request $request) {
        if (!Auth::check()) {
            $message = "Login to view history!";
            return redirect('login')->with('error', $message);
        } else {
            //get user
            $user = Auth::user();

            // get parameter values
            $status = $request->input('status');
            $startDate = $request->input('startDate');
            $endDate = $request->input('endDate');

            // filter data
            // $queryEducationTransaction = EducationTransaction::query()->where('userId', $user->id)->orderBy('created_at','desc');
            $latestEducationTransactions = EducationTransaction::query()
                ->selectRaw('MAX(id) as id')
                ->where('userId', $user->id)
                ->groupBy('education_id');

            $queryEducationTransaction = EducationTransaction::query()
                ->whereIn('id', $latestEducationTransactions);
            if ($status !== null) {
                $queryEducationTransaction->where('transaction_status', $status);
            }

            if ($startDate !== null) {
                $queryEducationTransaction->where('created_at', '>=', $startDate);
            }

            if ($endDate !== null) {
                $queryEducationTransaction->where('created_at', '<=', $endDate);
            }

            // fetch filtered data
            $educationTransactions = $queryEducationTransaction->paginate(4);

            return view('historyEducation', compact('educationTransactions'));
        }
    }

    public function searchHistory(Request $request) {
        $educationTransactions = EducationTransaction::whereHas(
            'educationContent', function ($query) use ($request) {
                $query->where('educationTitle', 'like', '%' . $request->searchValue . '%');
            }
        )->paginate(4);

        return view(
            'historyEducation',
            compact('educationTransactions')
        );
    }

    public function EditEducation($id){
        $education = EducationContent::findOrFail($id);
         $educationCategories = EducationCategory::orderBy(
            'educationCategory',
            'ASC'
        )->get();
        return view('admin.education.edit_education',compact('education', 'educationCategories'));
    }

    public function UpdateEducation(Request $req){
        $id = $req->id;
        
        $customMessages = [
            'educationTitle.required' => 'Education Title is Required!',
            'educationDesc.required' => 'Education Description is Required!',
            'educationShortDesc.required' => 'Education Short Description is Required!',
            'educationAuthor.required' => 'Education Author is Required!',
            'educationPrice.required' => 'Education Price is Required!',
            'educationPrice.integer' => 'Education Price must be an integer!',
            'educationCategory.required' => 'Education Category is Required!',
            'educationThumbnail.image' => 'Education Thumbnail must be a valid image file.',
            'educationThumbnail.mimes' => 'Education Thumbnail must be in one of the allowed image formats (jpeg, png, jpg, gif).',
            'educationVideo.mimes' => 'Education Video must be in one of the allowed formats (mp4, mov, avi, mkv, wmv).',
        ];

        $validatedData = $req->validate([
            'educationTitle' => 'required|string|max:255',
            'educationDesc' => 'required|string',
            'educationShortDesc' => 'required|string|max:255',
            'educationAuthor' => 'required|string|max:255',
            'educationCategory' => 'required|string|max:255',
            'educationPrice' => 'required|integer',
            'educationThumbnail' => 'image|mimes:jpeg,png,jpg,gif',
            'educationVideo' => 'mimes:mp4,mov,avi,mkv,wmv',
        ], $customMessages);

        $education = EducationContent::findOrFail($id);

        // Update fields that are required
        $education->educationTitle = $validatedData['educationTitle'];
        $education->educationCategory = $validatedData['educationCategory'];
        $education->education_category_id = $validatedData['educationCategory'];
        $education->educationShortDesc = $validatedData['educationShortDesc'];
        $education->educationDesc = $validatedData['educationDesc'];
        $education->educationAuthor = $validatedData['educationAuthor'];
        $education->educationPrice = $validatedData['educationPrice'];

        // Update thumbnail if provided
        if ($req->hasFile('educationThumbnail')) {
            $image = $req->file('educationThumbnail');
            $name_gen_img = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $directory = 'upload/education/';
            $save_url_img = $directory . $name_gen_img;
            $education->educationThumbnail = $save_url_img;
            Image::make($image)->resize(800, 450)->save(public_path($directory . $name_gen_img));
        }

        // Update video if provided
        if ($req->hasFile('educationVideo')) {
            $video = $req->file('educationVideo');
            $name_gen_vid = hexdec(uniqid()) . '.' . $video->getClientOriginalExtension();
            $directory = 'upload/education/';
            $save_url_vid = $directory . $name_gen_vid;
            $education->educationVideo = $save_url_vid;
            $video->move(public_path($directory), $name_gen_vid);
        }

        $education->save();

        $notification = [
            'message' => 'Education Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.education')->with($notification);
    }

}
