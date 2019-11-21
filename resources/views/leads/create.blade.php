@extends('laravel-admin::layouts.app')
@section('content')
<section class="section">
    <form role="form" method="POST" action="/admin/leads">
        @csrf
        <div class="row sameheight-container">
            <div class="col col-12 col-sm-12 col-md-6 col-xl-6">
                <div class="card sameheight-item" data-exclude="xs">
                    <div class="card-block">
                        <div class="title-block">
                            <h4 class="title">Create New Lead</h4>
                            @if ($errors->any())
                            <div class="field mt-6">
                                @foreach ($errors->all() as $error)
                                    <li class="text-sm text-red">{{ $error }}</li>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="phone">Phone</label>
                            <input type="text" id="phone" name="phone" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="description">Description</label>
                            <input type="text" id="description" name="description" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="source">Source</label>
                            <select name="source" id="source" class="form-control" required>
                                <option value="">Select Source</option>
                                @foreach ($sources as $source)
                                    <option value="{{$source->name}}">{{$source->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="status_id">Status</label>
                            <select name="status_id" id="status_id" class="form-control">
                                <option value="">Select Status</option>
                                @foreach ($statuses as $status)
                                    <option value="{{$status->id}}">{{$status->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="email">Assign to</label>
                            <select name="user_assigned_id" id="user_assigned_id" class="form-control">
                                <option value="">Select Manager</option>
                                @foreach ($lead_managers as $lead_manager)
                                    <option value="{{$lead_manager->id}}" {{Auth::user()->id == $lead_manager->id ? 'selected' : ''}}>{{$lead_manager->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-sm btn-success" value="Create">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection