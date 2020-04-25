<?php

namespace App\Http\Controllers;

use App\Lead;
use App\Source;
use App\Status;
use App\Exports\LeadsExport;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\LeadRequest;
use App\Notifications\LeadAssigned;
use Jenssegers\Agent\Facades\Agent;
use Maatwebsite\Excel\Facades\Excel;
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

    public function store(LeadRequest $request)
    {
        $attributes = $request->validated();

        $lead = Lead::create($attributes);

        if($lead->admin_assigned_id != auth()->user()->id){
            $lead->asignedTo->notify(new LeadAssigned($lead));
        }

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


    public function update(LeadRequest $request, Lead $lead)
    {
        $old_assigned_to = $lead->assigned_to;
        $attributes = $request->validated();

        $lead->update($attributes);

        if($lead->admin_assigned_id != $old_assigned_to && $lead->admin_assigned_id != auth()->user()->id){
            $lead->asignedTo->notify(new LeadAssigned($lead));
        }

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
            $leads = Lead::where('admin_assigned_id', auth()->user()->id);
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
            ->addColumn('phone', function($lead) {
                if(Agent::isMobile()){
                    return '<a href="tel:+88' . $lead->phone .'">' . $lead->phone .'</a>';
                }
                return $lead->phone;
            })
            ->editColumn('created_at', function($lead) {
                return $lead->created_at->format('d M y');
            })
            ->editColumn('updated_at', function($lead) {
                return $lead->updated_at->format('d M y');
            })
            ->rawColumns(['action', 'status', 'phone'])
            ->make(true);
    }

    public function export() 
    {
        $filename = 'leads' . time() . '.xlsx';
        return Excel::download(new LeadsExport, $filename);
    }
}
