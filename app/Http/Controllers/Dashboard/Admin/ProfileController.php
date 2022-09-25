<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Exception;
use Mockery\Generator\StringManipulation\Pass\Pass;

class ProfileController extends Controller
{
    public function index(){
        
        return view('dashboard.roles.admin.profile');
    }

    public function updateInformation(Request $request){
        
        $validation = [
            "firstName" => ["required","min:4","max:30"],
            "lastName" => ["required","min:4","max:30"],
            "address" => ["required","min:20","max:200"],
            "phone" => ["required","min:11","max:11"],

        ];

        $profileImageFromFrontend =  $request->file('profile_image');

        // validate image type if image is attached with request
        if($profileImageFromFrontend){
            $validation['profile_image' ] = 'required|mimes:jpg,jpeg,png,svg,webp,gif';
        }

        $request->validate($validation,);

        $imageNameForDatabase = null;

        if($profileImageFromFrontend){

            $nameGenerate = hexdec(uniqid());
            $imgageExtension = strtolower($profileImageFromFrontend->getClientOriginalExtension());
            $NewNameForImage = $nameGenerate.'.'.$imgageExtension;
            $upLocation = 'assets/images/profile/admin/';
            $profileImageFromFrontend->move($upLocation,$NewNameForImage);
            $imageNameForDatabase = $upLocation.$NewNameForImage;

            // delete image from folder storage
            try{
                $profile_image = auth()->guard('buyer')->user()->profile_image;

                if(!(str_contains($profile_image, 'profile_default.png') || str_contains($profile_image, 'FakeImages'))){
                    unlink($profile_image);
                }
            }
            catch(Exception $e){
                // pass if exception occur without errors
                // this exception occurs because of fakeImage path in database
            }
            

        }

        $adminFields = [
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'address' => $request->address,
            'about' => $request->about,
            'phone_number' => $request->phone,
        ];

        if($imageNameForDatabase){
            $adminFields['profile_image'] = $imageNameForDatabase;
            
        }


        // updating buyer fields from database
        $isUpdated = Admin::where('id','=', auth()->guard('admin')->user()->id)
            ->update($adminFields);

        if($isUpdated){
            return back()->with('success','Personal Information has been updated.');
        }
    }

    public function updatePassword(Request $request){

        $request->validate([
            'currentPassword' => 'required|min:4|max:30',
            'newPassword' => 'required|min:4|max:30',
        ]);

        
        if($request->currentPassword != auth()->guard('admin')->user()->password){
            // return back()->with('currentPasswordError', 'Current Password is not correct!')->withInput();
            return back()->with('error', 'Current Password is not correct!')
                        ->withErrors(['currentPassword' => 'Current Password is not correct!'])
                        ->withInput();
        }
        else if($request->newPassword == auth()->guard('admin')->user()->password){
            return back()->with('error', 'New password must be diffrent from current password!')
                        ->withErrors(['newPassword' => 'New password must be diffrent from current password!'])
                        ->withInput();
        }

       $isPasswordUpdated = Admin::where('id','=', auth()->guard('admin')->user()->id)
        ->update([
            'password' => $request->newPassword
        ]);

        if($isPasswordUpdated){
            // trying to logout current buyer to login again with new password
            auth()->guard('buyer')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('successPassChanged','Your password has been RESET, please login with new password now.');
        }

    }
}
