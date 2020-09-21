@extends('laravel-admin::layouts.app')
@section('content')
<section class="section">
    <form method="POST" action="/admin/leads">
        @csrf
        <div class="row sameheight-container">
            <div class="col col-12 col-sm-12 col-md-8 col-xl-8">
                <div class="card sameheight-item" data-exclude="xs">
                    <div class="card-block">
                        <div class="title-block">
                            <h4 class="title">Create New Lead</h4>
                        </div>
                        @include('leads.form', [
                            'lead' => new App\Models\Lead(),
                            'buttonText' => 'Create'
                        ])
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection
