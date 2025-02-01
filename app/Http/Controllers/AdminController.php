<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function adminList(){
        return view ('admin-list');
    }

    public function editProfile(Request $request)
    {
        try {
            if ($request->isMethod('get')) {
                $user = Auth::user();
                return view('edit-profile', compact('user'));
            }
            
            // Validate the request
            if ($request->isMethod('post')) {
                $validated = $request->validate([
                    'txtName' => 'nullable|string|max:255',
                    'txtPhone' => 'nullable|string|max:255',
                    'fulImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                ]);
        
                // Get the authenticated user
                $user = Auth::user();
        
                // Update user name or keep the old value if empty
                $user->name = !empty($validated['txtName']) ? $validated['txtName'] : $user->name;
        
                // Update user phone or keep the old value if empty
                $user->phone = !empty($validated['txtPhone']) ? $validated['txtPhone'] : $user->phone;
        
                // Handle profile image upload if provided
                if ($request->hasFile('fulImage')) {
                    $image_name = $request->file('fulImage')->getClientOriginalName();
                    $request->file('fulImage')->move(public_path('assets/images/user_images'), $image_name);
                    $image_path = 'assets/images/user_images/' . $image_name;
                    $user->profile_photo_path = $image_path;
                }

                $user->save();
                return redirect('/');
            }
        } catch(Exception $e){
            //TO-DO: change to proper error out
            return redirect('/change-password');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

    public function changePassword(Request $request){
        try{
            if ($request->isMethod('get')){
                $user = Auth::user();
                return view('change-password', compact('user'));
            }

            if ($request->isMethod('post')){

                $request->validate([
                    'txtCurrentPassword' => 'required|min:8',
                    'txtNewPassword' => 'required|min:8',
                ]);
                
                $msg = $request->txtCurrentPassword;
                //return view ('/admin-list', compact('msg'));
                $user = Auth::user();
        
                // Check if the current password matches
                if (!Hash::check($request->txtCurrentPassword, $user->password)) {
                    //return back()->withErrors(['txtCurrentPassword' => 'The current password is incorrect.']);
                    redirect('/admin-list');
                }
                
                // Update the user's password
                $user->password = Hash::make($request->txtNewPassword);
                $user->save();

                return redirect('/');
            }
        } catch (Exception $e){

        }
        
    }

    public function newAdmin(){
        return view("new-admin");
    }
}
