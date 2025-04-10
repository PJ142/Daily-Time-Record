<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AssignedInterns;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ManageUserController extends Controller
{
    public function ManageUsers()
    {
        $id = Auth::user()->id;
        $profile = User::find($id);

        // Get all users except those with 'admin' role
        $users = User::where('role', '!=', 'admin')->get();

        $assignedinterns = AssignedInterns::with(['intern', 'supervisor'])->get();

        return view('admin.manage_users', compact('profile', 'users', 'assignedinterns'));
    } //end
    public function CreateUsers()
    {
        $id = Auth::user()->id;
        $profile = User::find($id);
        $supervisors = User::where('role', 'supervisor')->get();
        $interns = User::where('role', 'intern')->get();

        return view('admin.create_users', compact('profile', 'supervisors', 'interns'));
    } //end
    public function StoreUsers(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed', // Will check against password_confirmation
            'role' => 'required|in:admin,supervisor,intern',
            'status' => 'required|in:active,inactive',
        ]);

        try {
            // Hash the password before saving
            $validatedData['password'] = Hash::make($validatedData['password']);

            // Create user
            User::create($validatedData);

            // Success notification
            $notification = array(
                'message' => 'User created successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            // Error notification
            $notification = array(
                'message' => 'Failed to create user. ' . $e->getMessage(),
                'alert-type' => 'error'
            );

            return back()->with($notification);
        }
    } //end
    public function EditUserDetails($id)
    {
        $profile = User::find($id);
        $users = User::findOrFail($id);

        return view('admin.edit_user_details', compact('profile', 'users'));
    }
    public function UpdateUserDetails(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'office' => 'nullable|string|max:255',
            'role' => 'required|string|in:supervisor,intern,admin',
            'status' => 'required|string|in:active,inactive',
        ]);

        // Retrieve the user
        $user = User::findOrFail($id);

        // Assign values
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->office = $request->office;
        $user->role = $request->role;
        $user->status = $request->status;

        // Only update password if provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Save changes
        $user->save();

        // Notification
        $notification = [
            'message' => 'User details updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('manage.users')->with($notification);
    } //end
    public function DeleteUserDetails($id)
    {
        User::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('manage.users')->with($notification);
    }
}