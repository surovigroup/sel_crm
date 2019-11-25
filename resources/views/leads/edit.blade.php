@extends('laravel-admin::layouts.app')
@section('content')
<section class="section">
    {!! Form::open(['url' => '/admin/leads/'.$lead->id, 'method' => 'PATCH']) !!}
        <div class="row sameheight-container">
            <div class="col col-12 col-sm-12 col-md-6 col-xl-6">
                <div class="card sameheight-item" data-exclude="xs">
                    <div class="card-block">
                        <div class="title-block">
                            <h4 class="title">Update</h4>
                        </div>
                        @include('leads.form', [
                            'lead' => $lead,
                            'buttonText' => 'Update'
                        ])
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
</section>
@endsection