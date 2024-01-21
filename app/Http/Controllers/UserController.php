<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\View\View;
use League\CommonMark\Extension\SmartPunct\EllipsesParser;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\FranchiseCategory;
use App\Models\Franchise;
use App\Models\News;
use App\Models\EducationContent;
use App\Models\EducationTransaction;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    public function userDashboard(Request $request){
         // Retrieve flashed data from the session

        $franchiseCategories = FranchiseCategory::latest()->take(3)->get();
        $successData = session('success_data');

        // Latest news
        $latestNews = News::latest()->first();

        // Filter franchise
        $categoryId = $request->input('category');

        $queryFranchise = Franchise::query();
        if($categoryId !== null) 
            $queryFranchise->where('franchise_category_id', $categoryId);

        $queryFranchise->where('status', 'Approved');

        // Fetch filtered data
        $franchises = $queryFranchise->limit(4)->get();

        // Pass the data to the view or use it as needed
        return view('dashboard', compact('franchiseCategories', 'franchises', 'latestNews'))->with('successData', $successData);
    }

      // Display the profile update form
      public function edit()
      {
          $user = Auth::user();
          return view('profile.edit', compact('user'));
      }

      public function update(Request $req){
        $userId = $req->id;

        //if theres any image
        if($req->file('profileImage')){
            $user = User::findOrFail($userId);

            if($user->profileImage != null || $user->profileImage != ""){
                $file_path = public_path($user->profileImage); // Get the absolute file path
                          
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }

            $image = $req->file('profileImage');
            $name_gen = hexdec(uniqid()). '.' . $image->getClientOriginalExtension();


             // Specify the desired directory path
             $directory = 'upload/user-profile/';

             $save_url = 'upload/user-profile/'.$name_gen;
 
              // Create the directory if it doesn't exist
              if (!Storage::exists($directory)) {
                  Storage::makeDirectory($directory);
              }

            //resize 
            Image::make($image)->resize(430,327)->save(public_path($directory . $name_gen));

            $save_url = 'upload/user-profile/'.$name_gen;

            User::findOrFail($userId)->update([
                'name' => $req->name,
                'email' => $req->email,
                'username' =>$req->username,
                'phoneNumber' => $req->phoneNumber,
                'profileImage' => $save_url
            ]); 
            
        }else{
            User::findOrFail($userId)->update([
                'name' => $req->name,
                'email' => $req->email,
                'username' =>$req->username,
                'phoneNumber' => $req->phoneNumber
            ]); 

        }

        $response = [
            'message' => 'Profile update successfully, please wait for approval',
            'modal' => '#successModal', // Modal ID to trigger
            ];

        // Flash the data to the session
        session()->flash('success_data', $response);        
    
        return  redirect()->route('profile.edit')->with('successData', $response);


        // $notification = array(
        //     'message' => 'Profile Updated Successfully',
        //     'alert-type' => 'success',
        // ); 

        // return redirect()->route('profile.edit')->with($notification);
      } // end method


      public function ChangePassword(){
        $user = Auth::user();

        return view('profile.changePassword',compact('user'));
      } // end method   

    public function UpdatePassword(Request $request){
        $user = Auth::user();

        if($user->password == ""){
            $validator = $request->validate([
            'password' => 'required|confirmed|min:8',
            ], [
                'password.required' => 'The new password is required.',
                'password.confirmed' => 'The new password confirmation does not match.',
                'password.min' => 'The new password must be at least 8 characters long.',
            ]);

            $user->password = $request->password;
            $user->save();

            return redirect()->route('dashboard')->with('password_change_success', true);
        }else{
            $validator = $request->validate([
            'old_password' => 'required|old_password',
            'password' => 'required|confirmed|min:8',
            ], [
                'old_password' => 'The current password is incorrect.',
                'password.required' => 'The new password is required.',
                'password.confirmed' => 'The new password confirmation does not match.',
                'password.min' => 'The new password must be at least 8 characters long.',
            ]);
            if (Hash::check($request->old_password, $user->password)) {
                $user->password = Hash::make($request->password);
                $user->save();
        
                return redirect()->route('dashboard')->with('password_change_success', true);
            } else {
                return back()->with('old_password', 'Current password is incorrect.');
            }
        }
        

        // dd(Hash::check($request->old_password, $user->password), $request->old_password, $user->password);
    
    } // end method


    public function deleteAccount(Request $request)
    {
        $user = auth()->user();

        // Check if the user is authenticated and authorized to delete their account
        if (!$user) {
            return redirect()->route('login');
        }

        // You can add additional confirmation steps here, such as asking for the current password.

        // Perform the deletion
        $user->delete();

        return redirect()->route('login')->with('success', 'Your account has been deleted.');
    } //end method


    public function AdminDashboard(){
        $transactions = EducationTransaction::latest()->get();

        //calculate user 
        $currentUser = User::whereMonth('created_at', Carbon::now()->month)->count();
        $previousMonthUser = User::whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
        $userDifference = $currentUser - $previousMonthUser;

        //calculate franchisor
        $currentFranchisor = User::where('role','Franchisor')->whereMonth('created_at', Carbon::now()->month)->count();
        $previousMonthFranchisor = User::where('role','Franchisor')->whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
        $franchisorDifference = $currentFranchisor - $previousMonthFranchisor;

        //calculate franchise
        $currentFranchise = Franchise::whereMonth('created_at', Carbon::now()->month)->count();
        $previousMonthFranchise = Franchise::whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
        $franchiseDifference = $currentFranchise - $previousMonthFranchise;

        //calculate education
        $currentEducation = EducationContent::whereMonth('created_at', Carbon::now()->month)->count();
        $previousMonthEducation = EducationContent::whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
        $educationDifference = $currentEducation - $previousMonthEducation;

        

        return view('admin.admin_index', compact('currentUser',
                                                'userDifference',
                                                'currentFranchisor',
                                                'franchisorDifference',
                                                'currentFranchise',
                                                'franchiseDifference',
                                                'currentEducation',
                                                'educationDifference',
                                                'transactions'
                                            ));
    }

    public function calculateMonthlyUserIncrease(){
        // Hitung tanggal awal dan akhir bulan lalu
        $startDate = Carbon::now()->subMonth()->startOfMonth();
        $endDate = Carbon::now()->subMonth()->endOfMonth();

        // Ambil jumlah pengguna dari bulan lalu
        $previousMonthUsers = User::whereBetween('created_at', [$startDate, $endDate])->count();

        // Ambil jumlah pengguna sekarang
        $currentUsers = User::count();

        // Hitung peningkatan dan persentasenya
        $increase = $currentUsers - $previousMonthUsers;
        $percentageIncrease = ($previousMonthUsers > 0) ? (($increase / $previousMonthUsers) * 100) : 0;

        // Tampilkan atau gunakan nilai persentase peningkatan
        return "Persentase Peningkatan Pengguna dari Bulan Lalu: " . number_format($percentageIncrease, 2) . "%";
    }
    
   
}
