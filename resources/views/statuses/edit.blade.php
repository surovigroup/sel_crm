@extends('laravel-admin::layouts.app')
@section('content')
<section class="section">
    <form role="form" method="POST" action="/admin/statuses/{{$status->id}}">
        @csrf
        @method('PATCH')
        <div class="row sameheight-container">
            <div class="col col-12 col-sm-12 col-md-6 col-xl-6">
                <div class="card sameheight-item" data-exclude="xs">
                    <div class="card-block">
                        <div class="title-block">
                            <h4 class="title">Edit Status</h4>
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
                            <input type="text" id="name" name="name" value="{{$status->name}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="phone">Color</label>
                            <input type="color" id="color" name="color" value="{{$status->color}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-sm btn-success" value="Update">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-12 col-sm-12 col-md-6 col-xl-6">
                <div class="card sameheight-item" data-exclude="xs">
                    <div class="card-block">

                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection