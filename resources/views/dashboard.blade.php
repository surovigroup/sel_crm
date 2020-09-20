@extends('laravel-admin::layouts.app')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
<section class="section">
    <div class="row">
        <div class="col col-12 col-sm-12 col-md-12 col-xl-12 stats-col">
            <div class="card stats" data-exclude="xs">
                <div class="card-header card-header-sm bordered">
                    <div class="header-block">
                        <h3 class="title">At a Glance</h3>
                    </div>
                </div>
                <div class="card-block">
                    <div class="row row-sm stats-container">
                        <div class="col-12 col-sm-3  stat-col">
                            <div class="custom-box">
                                <div class="stat-icon">
                                    <i class="fa fa-building"></i>
                                </div>
                                <div class="stat">
                                    <div class="value"> {{ $leadCount }} </div>
                                    <div class="name"> Leads </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 stat-col">
                            <div class="custom-box">
                                <div class="stat-icon">
                                    <i class="fa fa-sitemap"></i>
                                </div>
                                <div class="stat">
                                    <div class="value"> {{ $sourceCount }} </div>
                                    <div class="name"> Sources </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 stat-col">
                            <div class="custom-box">
                                <div class="stat-icon">
                                    <i class="fa fa-check-circle-o"></i>
                                </div>
                                <div class="stat">
                                    <div class="value"> {{ $order_confirmed }} </div>
                                    <div class="name"> Order Confirmed </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 stat-col">
                            <div class="custom-box">
                                <div class="stat-icon">
                                    <i class="fa fa-check-circle"></i>
                                </div>
                                <div class="stat">
                                    <div class="value"> {{ $order_completed }} </div>
                                    <div class="name"> Order Completed </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
