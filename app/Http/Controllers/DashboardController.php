<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $source_diversity = DB::table('leads')
                ->select('source',DB::raw('count(*) as total'))
                ->groupBy('source')
                ->get();
        $status_diversity = DB::table('leads')
                ->join('statuses', 'statuses.id' , '=', 'leads.status_id')
                ->select('leads.status_id','statuses.name as status', 'statuses.color as color' ,DB::raw('count(*) as total'))
                ->groupBy('status_id')
                ->get();
        $order_confirmed = DB::table('leads')
                ->where('status_id', 1)
                ->count();
        $order_completed = DB::table('leads')
                ->where('status_id', 6)
                ->count();
        return view('dashboard', [
            'leadCount' => Lead::count(),
            'sourceCount' => Source::count(),
            'order_confirmed' => $order_confirmed,
            'order_completed' => $order_completed,
            'source_diversity' => $source_diversity,
            'status_diversity' => $status_diversity
        ]);
    }
}
