@extends('admin.layouts.app')
@section('content')
<section class="section">
    <form role="form" method="POST" action="/users">
        @csrf
        <div class="row sameheight-container">
            <div class="col col-12 col-sm-12 col-md-6 col-xl-6">
                <div class="card sameheight-item" data-exclude="xs">
                    <div class="card-block">
                        <div class="title-block">
                            <h4 class="title">Create New user</h4>
                            @if ($errors->any())
                            <div class="field mt-6">
                                @foreach ($errors->all() as $error)
                                    <li class="text-sm text-red">{{ $error }}</li>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        <div class="form-group has-success">
                            <label class="control-label" for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control is-valid">
                        </div>
                        <div class="form-group has-success">
                            <label class="control-label" for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control is-valid">
                        </div>
                        <div class="form-group has-success">
                            <label class="control-label" for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control is-valid">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-sm btn-success" value="Create">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-12 col-sm-12 col-md-6 col-xl-6">
                <div class="card sameheight-item" data-exclude="xs">
                    <div class="card-block">
                        <div class="form-group">
                            <label class="control-label">Roles</label>
                            <div>
                                <label>
                                    <input class="checkbox" type="checkbox" name="roles[]" value="Superadmin">
                                    <span>Superadministrator</span>
                                </label>
                            </div>
                            <div>
                                <label>
                                    <input class="checkbox" type="checkbox" name="roles[]" value="Admin">
                                    <span>Administrator</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Permissions</label>
                            <div>
                                <label>
                                    <input class="checkbox" type="checkbox" value="">
                                    <span>Option one</span>
                                </label>
                            </div>
                            <div>
                                <label>
                                    <input class="checkbox" type="checkbox" value="">
                                    <span>Option two checked</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection