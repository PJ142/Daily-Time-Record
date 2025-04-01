<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DailyTimeRecords;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DailyTimeRecordsController extends Controller
{
    public function DailyTimeRecords()
    {
        $id = Auth::user()->id;
        $profile = User::find($id);
        $dtr = DailyTimeRecords::latest()->get();

        return view('admin.dtr', compact('profile', 'dtr'));
    } //end
}