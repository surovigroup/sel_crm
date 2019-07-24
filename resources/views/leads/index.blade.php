@extends('admin.layouts.app')
@section('content')
<section class="section">
    <div class="row sameheight-container">
        <div class="col col-12 col-sm-12 col-md-12 col-xl-12">
            <div class="card sameheight-item stats" data-exclude="xs">
                <div class="card-block">
                    <div class="title-block d-flex">
                        <h4 class="title"> Leads</h4>
                        <a class="btn btn-success btn-oval btn-sm ml-auto" href="/admin/leads/create">Create new</a>
                    </div>
                    <div class="row row-sm">
                        <div class="col-12 col-sm-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Source</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leads as $lead)
                                        <tr>
                                            <th scope="row">{{$lead->id}}</th>
                                            <td>{{$lead->name}}</td>
                                            <td>{{$lead->phone}}</td>
                                            <td>{{$lead->email}}</td>
                                            <td>{{$lead->source}}</td>
                                            <td>
                                                <span class="badge" style="color: #000; background-color: {{$lead->status->color}}; ">{{$lead->status->name}}</span>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-oval btn-info" href="/admin/leads/{{$lead->id}}">Details</a>
                                                <a class="btn btn-sm btn-oval btn-primary" href="/admin/leads/{{$lead->id}}/edit">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection