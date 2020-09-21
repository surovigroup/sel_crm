<?php

namespace App\Http\Controllers;

use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SourceController extends Controller
{
    public function index()
    {
        $sources = Source::all();
        return view('sources.index', [
            'sources'  => $sources
        ]);
    }

    public function create()
    {
        return view('sources.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name'  => 'required|unique:sources'
        ]);

        Source::create($attributes);

        Session::flash('message', 'Source created Successfully!!');
        Session::flash('alert-class', 'alert-success');

        return redirect('/admin/sources');
    }

    public function edit(Source $source)
    {
        return view('sources.edit', [
            'source'    => $source
        ]);
    }


    public function update(Request $request, Source $source)
    {
        $attributes = $request->validate([
            'name'  => 'required|unique:sources,name,'.$source->id
        ]);

        $source->update($attributes);

        Session::flash('message', 'Source Updated Successfully!!');
        Session::flash('alert-class', 'alert-success');

        return redirect('/admin/sources');
    }
}
