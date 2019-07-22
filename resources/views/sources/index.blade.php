@extends('admin.layouts.app')
@section('content')
<section class="section">
    <div class="row sameheight-container">
        <div class="col col-12 col-sm-12 col-md-12 col-xl-12">
            <div class="card sameheight-item stats" data-exclude="xs">
                <div class="card-block">
                    <div class="title-block d-flex">
                        <h4 class="title"> Sources</h4>
                        <a class="btn btn-success btn-oval btn-sm ml-auto" href="/admin/sources/create">Create new</a>
                    </div>
                    <div class="row row-sm">
                        <div class="col-12 col-sm-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sources as $source)
                                        <tr>
                                            <th scope="row">{{$source->id}}</th>
                                            <td>{{$source->name}}</td>
                                            <td>
                                                <a class="btn btn-sm btn-oval btn-info" href="/admin/sources/{{$source->id}}/edit">Edit</a>
                                                <a class="btn btn-sm btn-oval btn-primary" href="/admin/sources/{{$source->id}}">Show</a>
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