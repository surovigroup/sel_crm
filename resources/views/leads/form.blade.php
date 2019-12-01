<div class="row">
    <div class="col-md-12">
        @include('laravel-admin::form.fields.text', [
            'id' => 'name',
            'title' => 'Name',
            'value' => $lead->name
        ])
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        @include('laravel-admin::form.fields.text', [
            'id' => 'phone',
            'title' => 'Phone',
            'value' => $lead->phone
        ])
    </div>
    <div class="col-md-6">
        @include('laravel-admin::form.fields.email', [
            'id' => 'email',
            'title' => 'Email',
            'value' => $lead->email
        ])
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        @include('laravel-admin::form.fields.text', [
            'id' => 'description',
            'title' => 'Description',
            'value' => $lead->description
        ])
    </div>
    <div class="col-md-6">
        @include('laravel-admin::form.fields.text', [
            'id' => 'company',
            'title' => 'Company Name',
            'value' => $lead->company
        ])
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        @include('laravel-admin::form.fields.select', [
            'id'    =>  'division',
            'title' =>  'Division',
            'value' =>  $lead->division,
            'data'  =>  $divisions
        ])
    </div>
    <div class="col-md-4">
        @include('laravel-admin::form.fields.select', [
            'id'    =>  'district',
            'title' =>  'District',
            'value' =>  $lead->district,
            'data'  =>  $districts
        ])
    </div>
    <div class="col-md-4">
        @include('laravel-admin::form.fields.select', [
            'id'    =>  'upazila',
            'title' =>  'Upazila',
            'value' =>  $lead->upazila,
            'data'  =>  $upazilas
        ])
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        @include('laravel-admin::form.fields.select', [
            'id'    =>  'source',
            'title' =>  'Source',
            'value' =>  $lead->source,
            'data'  =>  $sources
        ])
    </div>
    <div class="col-md-4">
        @include('laravel-admin::form.fields.select', [
            'id'    =>  'status_id',
            'title' =>  'Status',
            'value' =>  $lead->status_id,
            'data'  =>  $statuses
        ])
    </div>
    <div class="col-md-4">
        @include('laravel-admin::form.fields.select', [
            'id'    =>  'user_assigned_id',
            'title' =>  'Assign to',
            'value' =>  $lead->user_assigned_id,
            'data'  =>  $lead_managers
        ])
    </div>
</div>

<div class="form-group">
    <input type="submit" class="btn btn-sm btn-success" value="{{ $buttonText }}">
</div>