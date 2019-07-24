<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StatusController extends Controller
{
    public function index()
    {
        $statuses = Status::all();
        return view('statuses.index', [
            'statuses'  => $statuses
        ]);
    }

    public function create()
    {
        return view('statuses.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name'  => 'required',
            'color'  => 'required'
        ]);

        Status::create($attributes);

        Session::flash('message', 'Status created Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect('/admin/statuses');
    }

    public function edit(Status $status)
    {
        return view('statuses.edit', [
            'status'    => $status
        ]);
    }

    public function update(Request $request, Status $status)
    {
        $attributes = $request->validate([
            'name'  => 'required',
            'color'  => 'required'
        ]);

        $status->update($attributes);

        Session::flash('message', 'Status updated Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect('/admin/statuses');
    }
}
