<div class="row">
    <div class="col-md-12">
        @include('laravel-admin::form.text', [
            'name'  => 'name',
            'label' => 'Name',
            'value' => $lead->name
        ])
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        @include('laravel-admin::form.text', [
            'name'  => 'phone',
            'label' => 'Phone',
            'value' => $lead->phone
        ])
    </div>
    <div class="col-md-6">
        @include('laravel-admin::form.email', [
            'name'  => 'email',
            'label' => 'Email',
            'value' => $lead->email
        ])
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        @include('laravel-admin::form.text', [
            'name'  => 'description',
            'label' => 'Description',
            'value' => $lead->description
        ])
    </div>
    <div class="col-md-6">
        @include('laravel-admin::form.text', [
            'name'  => 'company',
            'label' => 'Company Name',
            'value' => $lead->company
        ])
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        @include('laravel-admin::form.select', [
            'name'  =>  'division',
            'label' =>  'Division',
            'value' =>  $lead->division,
            'data'  =>  $divisions
        ])
    </div>
    <div class="col-md-4">
        @include('laravel-admin::form.select', [
            'name'  =>  'district',
            'label' =>  'District',
            'value' =>  $lead->district,
            'data'  =>  $districts
        ])
    </div>
    <div class="col-md-4">
        @include('laravel-admin::form.select', [
            'name'  =>  'upazila',
            'label' =>  'Upazila',
            'value' =>  $lead->upazila,
            'data'  =>  $upazilas
        ])
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        @include('laravel-admin::form.select', [
            'name'  =>  'source',
            'label' =>  'Source',
            'value' =>  $lead->source,
            'data'  =>  $sources
        ])
    </div>
    <div class="col-md-4">
        @include('laravel-admin::form.select', [
            'name'  =>  'status_id',
            'label' =>  'Status',
            'value' =>  $lead->status_id,
            'data'  =>  $statuses
        ])
    </div>
    <div class="col-md-4">
        @include('laravel-admin::form.select', [
            'name'  =>  'user_assigned_id',
            'label' =>  'Assign to',
            'value' =>  $lead->user_assigned_id,
            'data'  =>  $lead_managers
        ])
    </div>
</div>

<div class="form-group">
    <input type="submit" class="btn btn-sm btn-success" value="{{ $buttonText }}">
</div>

@section('javascript')
    <script>
        function searchable_select(selector){
            $(selector).select2({
                theme: 'bootstrap4',
                width: 'style',
                placeholder: $(this).attr('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
            });
        }
        searchable_select('#division');
        searchable_select('#district');
        searchable_select('#upazila');
        searchable_select('#source');
        searchable_select('#status_id');
        searchable_select('#user_assigned_id');
    </script>
@endsection