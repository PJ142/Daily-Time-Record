<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AssignedInterns;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AssignedInternsController extends Controller
{
    public function Interns()
    {
        $id = Auth::user()->id;
        $profile = User::find($id);

        // Get all users who are supervisors
        $supervisors = User::where('role', 'supervisor')
            ->with(['assignedInterns' => function ($query) {
                $query->with('intern');
            }])
            ->get();

        return view('admin.admin_interns', compact('profile', 'supervisors'));
    }
    //end
    public function AssignedInterns()
    {
        $id = Auth::user()->id;
        $profile = User::find($id);
        $supervisors = User::where('role', 'supervisor')->get();

        // Get IDs of already assigned interns
        $assignedInternIds = AssignedInterns::pluck('intern_id')->toArray();

        // Fetch only interns who are NOT assigned
        $interns = User::where('role', 'intern')
            ->whereNotIn('id', $assignedInternIds) // Exclude assigned interns
            ->get();

        return view('admin.assign_interns', compact('profile', 'interns', 'supervisors'));
    }
    //end
    public function StoreAssignedInterns(Request $request)
    {
        $request->validate([
            'supervisor_id' => 'required',
            'intern_id' => 'required',
            'internship_start_date' => 'required',
            'internship_end_date' => 'required',
            'total_hours' => 'required'
        ]);

        DB::table('assigned_interns')->insert([
            'supervisor_id' => $request->supervisor_id,
            'intern_id' => $request->intern_id,
            'internship_start_date' => $request->internship_start_date,
            'internship_end_date' => $request->internship_end_date,
            'total_hours' => $request->total_hours,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $notification = array(
            'message' => 'Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('interns')->with($notification);
    } //end
    public function EditAssignedInterns($id)
    {
        $profile = User::find($id);
        $assignintern = AssignedInterns::findOrFail($id);
        $supervisors = User::where('role', 'supervisor')->get();
        $interns = User::where('role', 'intern')->get();

        return view('admin.edit_assigned_interns', compact('assignintern', 'supervisors', 'interns', 'profile'));
    } //end
    public function UpdateAssignedInterns(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'intern_name' => 'required|string|max:255',
            'supervisor_id' => 'required|exists:users,id',
            'internship_start_date' => 'required|date',
            'internship_end_date' => 'required|date',
            'total_hours' => 'required'
        ]);

        // Retrieve the assigned intern record
        $assignintern = AssignedInterns::findOrFail($id);

        // Retrieve the intern user record
        $intern = User::find($assignintern->intern_id);

        // Update the intern's name if they exist
        if ($intern) {
            $intern->update([
                'name' => $request->intern_name,  // Update the intern's name
            ]);
        }

        // Update the assigned intern record
        $assignintern->update([
            'supervisor_id' => $request->supervisor_id,  // Update the supervisor assignment
            'internship_start_date' => $request->internship_start_date,
            'internship_end_date' => $request->internship_end_date,
            'total_hours' => $request->total_hours
        ]);

        $notification = array(
            'message' => 'Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('interns')->with($notification);
    } //end
    public function DeleteAssignedInterns($id)
    {

        AssignedInterns::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}