<?php

namespace App\Http\Controllers;

use App\Lead;
use App\User;
use App\Source;
use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LeadController extends Controller
{

    public function index()
    {
        $leads = Lead::all();
        return view('leads.index', [
            'leads' => $leads
        ]);
    }

    public function create()
    {
        $lead_managers = $users = User::permission('lead_manager')->get();
        $statuses = Status::all();
        $sources = Source::all();
        return view('leads.create', [
            'lead_managers' => $lead_managers,
            'statuses'      => $statuses,
            'sources'       => $sources
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name'      => 'required',
            'phone'     => 'required|unique:leads',
            'email'     => 'nullable|email',
            'source'    => 'required',
        ]);

        $attributes['description'] = $request->description;
        $attributes['user_created_id'] = auth()->user()->id;
        $attributes['user_assigned_id'] = $request->user_assigned_id ?? auth()->user()->id;
        $attributes['status_id'] = $request->status_id ?? Status::first()->id;

        Lead::create($attributes);

        Session::flash('message', 'Lead created Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect('/admin/leads');
    }
}
