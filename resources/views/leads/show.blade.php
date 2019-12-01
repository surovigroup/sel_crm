@extends('laravel-admin::layouts.app')
@section('content')
<section class="section">
    <div class="row sameheight-container">
        <div class="col col-12 col-sm-12 col-md-6 col-xl-6">
            <div class="card sameheight-item" data-exclude="xs">
                <div class="card-block">
                    <div class="title-block">
                        <h3>{{$lead->name}} <span class="badge" style="color: #000; background-color: {{$lead->status->color}}; ">{{$lead->status->name}}</span></h2>
                    </div>
                    @if($lead->division || $lead->district || $lead->upazila)
                    <p><span class="pr-2 fa fa-map-marker"> </span> {{ implode( ', ', array_filter( [$lead->upazila, $lead->district, $lead->division] ) ) }}</p>
                    @endif
                    <p><span class="pr-2 fa fa-phone"> </span> {{$lead->phone}}</p>
                    <p><span class="pr-2 fa fa-envelope"> </span> {{$lead->email ?? 'N/A'}}</p>
                    <p><span class="pr-2 fa fa-comment"> </span> {{$lead->description ?? 'N/A'}}</p>
                    <p><span class="pr-2 fa fa-external-link"> </span> {{$lead->source}}</p>
                    <p><span class="pr-2 fa fa-user"> </span> {{$lead->asignedTo->name}}</p>
                    <hr>
                    <div class="row">
                        <div class="col col-4">
                            <form role="form" method="POST" action="/admin/leads/{{$lead->id}}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <select name="status_id" id="status_id" class="form-control" required>
                                        <option value="">Select Status</option>
                                        @foreach ($statuses as $status)
                                            <option value="{{$status->id}}" {{ $lead->status_id == $status->id ? 'selected' : '' }}>{{$status->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-sm btn-success" value="Update Status">
                                    <a class="btn btn-sm btn-info" href="/admin/leads">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection