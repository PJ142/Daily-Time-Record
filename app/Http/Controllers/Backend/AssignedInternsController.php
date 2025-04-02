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
        $intern = AssignedInterns::latest()->get();

        return view('admin.admin_interns', compact('profile', 'intern'));
    } //end
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
            'internship_end_date' => 'required'
        ]);

        DB::table('assigned_interns')->insert([
            'supervisor_id' => $request->supervisor_id,
            'intern_id' => $request->intern_id,
            'internship_start_date' => $request->internship_start_date,
            'internship_end_date' => $request->internship_end_date,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('interns')->with('success', 'Intern assigned successfully.');
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
        // Retrieve the assignment record
        $assignintern = AssignedInterns::findOrFail($id);

        // Retrieve the associated intern and supervisor user records
        $intern = User::find($assignintern->intern_id);
        $supervisor = User::find($assignintern->supervisor_id);

        // Update the intern's name if the intern record is found
        if ($intern) {
            $intern->name = $request->intern_name;
            $intern->save();
        }

        // Update the supervisor's name if the supervisor record is found
        if ($supervisor) {
            $supervisor->name = $request->supervisor_name;
            $supervisor->save();
        }

        // Update the assignment record (dates)
        $assignintern->update([
            'internship_start_date' => $request->internship_start_date,
            'internship_end_date'   => $request->internship_end_date,
        ]);

        return redirect()->route('interns')->with('success', 'Intern assignment updated successfully.');
    } //end
}