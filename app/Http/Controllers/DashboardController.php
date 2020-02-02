<?php

namespace App\Http\Controllers;

use App\Lead;
use App\Source;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'leadCount' => Lead::count(),
            'sourceCount' => Source::count(),
        ]);
    }
}
