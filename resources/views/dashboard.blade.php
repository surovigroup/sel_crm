@extends('laravel-admin::layouts.app')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>

<x-laravel-admin::stats-section title="At a Glance">
    <x-laravel-admin::stats-item :count="$leadCount" label="Leads" icon="fa fa-building"/>
    <x-laravel-admin::stats-item :count="$sourceCount" label="Sources" icon="fa fa-sitemap"/>
    <x-laravel-admin::stats-item :count="$order_confirmed" label="Order Confirmed" icon="fa fa-check-circle-o"/>
    <x-laravel-admin::stats-item :count="$order_completed" label="Order Completed" icon="fa fa-check-circle"/>
</x-laravel-admin::stats-section>

<section class="section map-tasks">
    <div class="row sameheight-container">
        <div class="col-md-12">
            <div class="card sameheight-item" data-exclude="xs,sm">
                <div class="card-header">
                    <div class="header-block">
                        <h3 class="title"> Lead Diversity by Status</h3>
                    </div>
                </div>
                @include('charts.statusDiversity')
            </div>
        </div>
    </div>
</section>
<section class="section map-tasks">
    <div class="row sameheight-container">
        <div class="col-md-12">
            <div class="card sameheight-item" data-exclude="xs,sm">
                <div class="card-header">
                    <div class="header-block">
                        <h3 class="title"> Lead Diversity by Source</h3>
                    </div>
                </div>
                @include('charts.sourceDiversity')
            </div>
        </div>
    </div>
</section>
@endsection
@section('javascript')
<style>
    .custom-box{
        background: #c6f6d5;
        padding: 10px 0;
        border-radius: 5px;
        color: #22543d;
    }
    .custom-box i{
        color: #38a169;
    }
    .custom-box:hover{
        background: #9ae6b4;
    }
</style>
@endsection
