@include('laravel-admin::form.fields.text', [
    'id' => 'name',
    'title' => 'Name',
    'value' => $lead->name
])
@include('laravel-admin::form.fields.text', [
    'id' => 'phone',
    'title' => 'Phone',
    'value' => $lead->phone
])
@include('laravel-admin::form.fields.email', [
    'id' => 'email',
    'title' => 'Email',
    'value' => $lead->email
])
@include('laravel-admin::form.fields.text', [
    'id' => 'description',
    'title' => 'Description',
    'value' => $lead->description
])
@include('laravel-admin::form.fields.select', [
    'id'    =>  'source',
    'title' =>  'Source',
    'value' =>  $lead->source,
    'data'  =>  $sources
])
@include('laravel-admin::form.fields.select', [
    'id'    =>  'status_id',
    'title' =>  'Status',
    'value' =>  $lead->status_id,
    'data'  =>  $statuses
])
@include('laravel-admin::form.fields.select', [
    'id'    =>  'user_assigned_id',
    'title' =>  'Assign to',
    'value' =>  $lead->user_assigned_id,
    'data'  =>  $lead_managers
])

<div class="form-group">
    <input type="submit" class="btn btn-sm btn-success" value="{{ $buttonText }}">
</div>