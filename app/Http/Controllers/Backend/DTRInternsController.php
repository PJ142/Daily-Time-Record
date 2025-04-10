<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AssignedInterns;
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
}