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
@can('manage_stock')
<li class="{{ request()->is('admin/techplatoon/brands/*') ? 'active open' : '' }}" >
    <a href="">
        <i class="fa fa-shopping-cart"></i> Manage Stock <i class="fa arrow"></i>
    </a>
    <ul class="sidebar-nav">
        <li class="{{(request()->is('admin/techplatoon/brands/354')) ? 'active' : '' }}">
            <a href="/admin/techplatoon/brands/354"> <i class="fa fa-briefcase"> </i> Belkin </a>
        </li>
        <li class="{{(request()->is('admin/techplatoon/brands/359')) ? 'active' : '' }}">
            <a href="/admin/techplatoon/brands/359"> <i class="fa fa-briefcase"> </i> Benq </a>
        </li>
        <li class="{{(request()->is('admin/techplatoon/brands/212')) ? 'active' : '' }}">
            <a href="/admin/techplatoon/brands/212"> <i class="fa fa-briefcase"> </i> Chuwi </a>
        </li>
        <li class="{{(request()->is('admin/techplatoon/brands/347')) ? 'active' : '' }}">
            <a href="/admin/techplatoon/brands/347"> <i class="fa fa-briefcase"> </i> Colorful </a>
        </li>
        <li class="{{(request()->is('admin/techplatoon/brands/358')) ? 'active' : '' }}">
            <a href="/admin/techplatoon/brands/358"> <i class="fa fa-briefcase"> </i> Energizer </a>
        </li>
        <li class="{{(request()->is('admin/techplatoon/brands/111')) ? 'active' : '' }}">
            <a href="/admin/techplatoon/brands/111"> <i class="fa fa-briefcase"> </i> I-Life </a>
        </li>
        <li class="{{(request()->is('admin/techplatoon/brands/349')) ? 'active' : '' }}">
            <a href="/admin/techplatoon/brands/349"> <i class="fa fa-briefcase"> </i> Motospeed </a>
        </li>
        <li class="{{(request()->is('admin/techplatoon/brands/246')) ? 'active' : '' }}">
            <a href="/admin/techplatoon/brands/246"> <i class="fa fa-briefcase"> </i> Steel Series </a>
        </li>
        <li class="{{(request()->is('admin/techplatoon/brands/112')) ? 'active' : '' }}">
            <a href="/admin/techplatoon/brands/112"> <i class="fa fa-briefcase"> </i> Ugreen </a>
        </li>
    </ul>
</li>
@endcan
<li class="{{(request()->is('admin/leads*')) ? 'active' : '' }}">
    <a href="/admin/leads">
        <i class="fa fa-users"></i> Leads </a>
</li>