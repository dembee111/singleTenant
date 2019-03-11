<?php

namespace App\Http\Controllers\Tenant;

use App\Company;
use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
    	$projects = Project::all();
    	return view('tenant.dashboard', compact('projects'));
    }
}
