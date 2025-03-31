<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function AdminDashboard(){

        return view('admin.index');
    }//end

    public function AdminLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }//end

    public function Adminlogin(){

        return view('admin.admin_login');
    }//end

    public function AdminProfile(){

        $id = Auth::user()->id;
        $profile = User::find($id);
        
        return view('admin.admin_profile', compact('profile'));
    }

    public function AdminProfileStore(Request $request){

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->username = $request->username;
        
        if ($request->file('photo')) {
            // Delete the old profile image if it exists
            if ($data->photo && file_exists(public_path('upload/admin_images/' . $data->photo))) {
                @unlink(public_path('upload/admin_images/' . $data->photo));
            }
            //new Image
            $file = $request->file('photo');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
    
            // Update database
            $data->photo = $filename;
        }
    
        $data->save();

        $notification = array(
            'message' => 'Admin Profile Upadated Successfuly',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}