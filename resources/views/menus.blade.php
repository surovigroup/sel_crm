@can('manage_status')
<li class="{{(request()->is('admin/statuses*')) ? 'active' : '' }}">
    <a href="/admin/statuses">
        <i class="fa fa-tag"></i> Statuses </a>
</li>
@endcan
@can('manage_source')
<li class="{{(request()->is('admin/sources*')) ? 'active' : '' }}">
    <a href="/admin/sources">
        <i class="fa fa-external-link"></i> Source </a>
</li>
@endcan
<li class="{{(request()->is('admin/leads*')) ? 'active' : '' }}">
    <a href="/admin/leads">
        <i class="fa fa-users"></i> Leads </a>
</li>