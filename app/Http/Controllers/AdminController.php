<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        $id = Auth::user()->id;
        $profile = User::find($id);

        return view('admin.index', compact('profile'));
    } //end

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    } //end

    public function Adminlogin()
    {

        return view('admin.admin_login');
    } //end

    public function AdminProfile()
    {

        $id = Auth::user()->id;
        $profile = User::find($id);

        return view('admin.admin_profile', compact('profile'));
    } //end

    public function AdminProfileStore(Request $request)
    {

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
    } //end

    public function AdminChangePassword()
    {
        $id = Auth::user()->id;
        $profile = User::find($id);

        return view('admin.admin_change_password', compact('profile'));
    } //end

    public function AdminUpdatePassword(Request $request)
    {

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        //Match Old Password
        if (!Hash::check($request->old_password, auth::user()->password)) {

            $notification = array(
                'message' => 'Old Password Does not Match!!!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        //Update New Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Password Change Successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}