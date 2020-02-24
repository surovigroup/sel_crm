<?php

namespace App\Http\Controllers;

use App\Lead;
use App\Source;
use App\Status;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Devfaysal\LaravelAdmin\Models\Admin;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Division;

class LeadController extends Controller
{

    public function index()
    {

        return view('leads.index');
    }

    public function create()
    {
        return view('leads.create', [
            'lead_managers' => Admin::permission('lead_manager', 'admin')->pluck('name', 'id')->toArray(),
            'statuses'      => Status::pluck('name', 'id')->toArray(),
            'sources'       => Source::pluck('name', 'name')->toArray(),
            'divisions'     => Division::pluck('name', 'name')->toArray(),
            'districts'     => District::pluck('name', 'name')->toArray(),
            'upazilas'      => Upazila::pluck('name', 'name')->toArray(),
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name'      => 'required',
            'phone'     => 'required|digits:11|unique:leads',
            'email'     => 'nullable|email|unique:leads',
            'source'    => 'required',
            'company'   => 'nullable',
            'district'  => 'nullable',
            'division'  => 'nullable',
            'upazila'   => 'nullable',
        ]);

        $attributes['description'] = $request->description;
        $attributes['admin_created_id'] = auth()->user()->id;
        $attributes['admin_assigned_id'] = $request->admin_assigned_id ?? auth()->user()->id;
        $attributes['status_id'] = $request->status_id ?? Status::first()->id;

        Lead::create($attributes);

        Session::flash('message', 'Lead created Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect('/admin/leads');
    }

    public function edit(Lead $lead)
    {
        return view('leads.edit', [
            'lead'          => $lead,
            'lead_managers' => Admin::permission('lead_manager','admin')->pluck('name', 'id')->toArray(),
            'statuses'      => Status::pluck('name', 'id')->toArray(),
            'sources'       => Source::pluck('name', 'name')->toArray(),
            'divisions'     => Division::pluck('name', 'name')->toArray(),
            'districts'     => District::pluck('name', 'name')->toArray(),
            'upazilas'      => Upazila::pluck('name', 'name')->toArray(),
        ]);
    }


    public function update(Request $request, Lead $lead)
    {
        $attributes = $request->validate([
            'name'      => 'required',
            'phone'     => 'required|digits:11|unique:leads,phone,' . $lead->id,
            'email'     => 'nullable|email|unique:leads,email,' . $lead->id,
            'source'    => 'required',
            'company'   => 'nullable',
            'district'  => 'nullable',
            'division'  => 'nullable',
            'upazila'   => 'nullable',
        ]);

        $attributes['description'] = $request->description;
        $attributes['admin_assigned_id'] = $request->admin_assigned_id ?? auth()->user()->id;
        $attributes['status_id'] = $request->status_id ?? Status::first()->id;

        $lead->update($attributes);

        Session::flash('message', 'Lead updated Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect('/admin/leads');
    }

    public function updateStatus(Request $request, Lead $lead)
    {
        $request->validate([
            'status_id' => 'required',
        ]);
        
        $lead->status_id = $request->status_id;
        $lead->save();
        Session::flash('message', 'Status updated Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect('/admin/leads/'. $lead->id);
    }

    public function show(Lead $lead)
    {
        $statuses = Status::all();
        return view('leads.show', [
            'statuses'  => $statuses,
            'lead'      => $lead
        ]);
    }

    public function datatable()
    {
        if(auth()->user()->hasRole('admin')){
            $leads = Lead::query();
        }else{
            $leads = Lead::where('user_assigned_id', auth()->user()->id);
        }

        return DataTables::of($leads)
            ->addColumn('action', function($lead) {
                $string = '';
                $string .= '<a class="btn btn-sm btn-oval btn-info" href="'. route('leads.edit', $lead->id) .'">Edit</a>';
                $string .= ' <a class="btn btn-sm btn-oval btn-primary" href="'. route('leads.show', $lead->id) .'">Show</a>';
                return $string;
            })
            ->addColumn('status', function($lead) {
                $string = '<span class="badge" style="color: #000; background-color: '. $lead->status->color .'; ">'. $lead->status->name .'</span>';
                return $string;
            })
            ->addColumn('created_by', function($lead) {
                return $lead->createdBy->name;
            })
            ->addColumn('created_at', function($lead) {
                return $lead->created_at->format('d-m-y');
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }
}
