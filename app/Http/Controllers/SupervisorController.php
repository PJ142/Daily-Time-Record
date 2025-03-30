<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function SupervisorDashboard(){

        return view('supervisor.supervisor_dashboard');
    }
}
