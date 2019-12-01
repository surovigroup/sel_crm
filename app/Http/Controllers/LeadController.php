<?php

namespace App\Http\Controllers;

use App\Lead;
use App\User;
use App\Source;
use App\Status;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
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
        $lead_managers = $users = User::permission('lead_manager')->get();
        $lead_manager_options = [];
        foreach($lead_managers as $lead_manager){
            $lead_manager_options[$lead_manager->id] = $lead_manager->name;
        }

        $statuses = Status::get();
        $status_options = [];
        foreach($statuses as $status){
            $status_options[$status->id] = $status->name;
        }

        $sources = Source::get();
        $source_options = [];
        foreach($sources as $source){
            $source_options[$source->name] = $source->name;
        }
        $divisions = Division::get()->pluck('name', 'name')->toArray();
        $districts = District::get()->pluck('name', 'name')->toArray();
        $upazilas = Upazila::get()->pluck('name', 'name')->toArray();
        
        return view('leads.create', [
            'lead_managers' => $lead_manager_options,
            'statuses'      => $status_options,
            'sources'       => $source_options,
            'divisions'     => $divisions,
            'districts'     => $districts,
            'upazilas'      => $upazilas,
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
        $attributes['user_created_id'] = auth()->user()->id;
        $attributes['user_assigned_id'] = $request->user_assigned_id ?? auth()->user()->id;
        $attributes['status_id'] = $request->status_id ?? Status::first()->id;

        Lead::create($attributes);

        Session::flash('message', 'Lead created Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect('/admin/leads');
    }

    public function edit(Lead $lead)
    {
        $lead_managers = $users = User::permission('lead_manager')->get();
        $lead_manager_options = [];
        foreach($lead_managers as $lead_manager){
            $lead_manager_options[$lead_manager->id] = $lead_manager->name;
        }

        $statuses = Status::get();
        $status_options = [];
        foreach($statuses as $status){
            $status_options[$status->id] = $status->name;
        }

        $sources = Source::get();
        $source_options = [];
        foreach($sources as $source){
            $source_options[$source->name] = $source->name;
        }
        $divisions = Division::get()->pluck('name', 'name')->toArray();
        $districts = District::get()->pluck('name', 'name')->toArray();
        $upazilas = Upazila::get()->pluck('name', 'name')->toArray();
        return view('leads.edit', [
            'lead'          => $lead,
            'lead_managers' => $lead_manager_options,
            'statuses'      => $status_options,
            'sources'       => $source_options,
            'divisions'     => $divisions,
            'districts'     => $districts,
            'upazilas'      => $upazilas,
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
        $attributes['user_assigned_id'] = $request->user_assigned_id ?? auth()->user()->id;
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
            $leads = Lead::all();
        }else{
            $leads = Lead::where('user_assigned_id', auth()->user()->id)->get();
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
