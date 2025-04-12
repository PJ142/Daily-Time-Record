<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AssignedInterns;
use App\Models\DtrInterns;
use Illuminate\Support\Facades\Auth;

class DTRInternsController extends Controller
{
    public function DTRInterns()
    {
        $id = Auth::user()->id;
        $profile = User::find($id);

        $supervisors = User::with([
            'assignedInterns.intern',
            'assignedInterns.dtrInterns'
        ])->where('role', 'supervisor')->get();

        return view('admin.dtr_intern', compact('profile', 'supervisors'));
    }
    public function CreateDTRInterns($assigned_intern_id)
    {
        $id = Auth::user()->id;
        $profile = User::find($id);

        $assignedInterns = AssignedInterns::with(['intern', 'supervisor'])->get();
        $selectedAssignedInternId = $assigned_intern_id;

        return view('admin.create_dtr_intern', compact('profile', 'assignedInterns', 'selectedAssignedInternId'));
    }
    public function StoreDTRInterns(Request $request)
    {
        $request->validate([
            'assigned_intern_id' => 'required|exists:assigned_interns,id',
            'date' => 'required|date',
            'time_in_am' => 'nullable',
            'time_out_am' => 'nullable',
            'time_in_pm' => 'nullable',
            'time_out_pm' => 'nullable',
        ]);

        DtrInterns::create([
            'assigned_intern_id' => $request->assigned_intern_id,
            'date' => $request->date,
            'time_in_am' => $request->time_in_am,
            'time_out_am' => $request->time_out_am,
            'time_in_pm' => $request->time_in_pm,
            'time_out_pm' => $request->time_out_pm,
        ]);

        $notification = array(
            'message' => 'Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('interns')->with($notification);
    } //end
    public function ViewDTRInterns($assigned_intern_id)
    {
        // Get admin profile (optional, if needed in the view)
        $profile = Auth::user();

        // Use the correct assigned intern ID passed from the route
        $assigned = AssignedInterns::with('intern')->findOrFail($assigned_intern_id);

        $dtrs = DtrInterns::where('assigned_intern_id', $assigned_intern_id)
            ->orderByDesc('date')
            ->get();

        return view('admin.view_dtr_intern', compact('dtrs', 'assigned', 'profile'));
    } //end

}