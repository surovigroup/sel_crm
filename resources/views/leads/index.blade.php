@extends('laravel-admin::layouts.app')
@section('content')
<section class="section">
    <div class="row">
        <div class="col col-12 col-sm-12 col-md-12 col-xl-12">
            <div class="card" data-exclude="xs">
                <div class="card-block">
                    <div class="title-block d-flex">
                        <h4 class="title"> Leads</h4>
                        <a class="btn btn-success btn-oval btn-sm ml-auto" href="/admin/leads/create">Create new</a>
                    </div>
                    <div class="row row-sm">
                        <div class="col-12 col-sm-12">
                            <div class="table-responsive">
                                <table id="leads-table" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="hide">#</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Location</th>
                                            <th>Company</th>
                                            <th>Note</th>
                                            <th>Source</th>
                                            <th>Created By</th>
                                            <th>Created at</th>
                                            <th>Status</th>
                                            <th class="hide">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('javascript')
<script>
    $('#leads-table').DataTable({
        order: [[ 0, "desc" ]],
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: '{{route('leads.datatable')}}',
        columns: [
            {data: 'id', name: 'id', visible: false},
            {data: 'name', name: 'name', responsivePriority: -4},
            {data: 'phone', name: 'phone', responsivePriority: -3},
            {data: 'district', name: 'district', responsivePriority: 97},
            {data: 'company', name: 'company', responsivePriority: 95},
            {data: 'note', name: 'note', responsivePriority: 99},
            {data: 'source', name: 'source', responsivePriority: 94},
            {data: 'created_by', name: 'created_by', responsivePriority: -1},
            {data: 'created_at', name: 'created_at', responsivePriority: 96},
            {data: 'status', name: 'status', responsivePriority: -2},
            {data: 'action', name: 'action', orderable: false, searchable: false, responsivePriority: 98}
        ],
    });
</script>
@endsection