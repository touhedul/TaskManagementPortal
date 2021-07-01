{{-- @include('layouts.menu') --}}
<li class="app-sidebar__heading">Welcome To The Admin Panel</li>
{{-- Dashboard --}}
<li class="">
    <a href="{{route('admin.dashboard')}}" class="{{ Request::is('rt-admin/dashboard*') ? 'mm-active' : '' }}">
        <i class="metismenu-icon pe-7s-box2"></i>
        Dashboard
    </a>
</li>
{{-- Admins --}}
@if(Auth::user()->super_admin == 1)
<li class="">
    <a href="{{route('admin.admins.index')}}" class="{{ Request::is('rt-admin/admins*') ? 'mm-active' : '' }}">
        <i class="metismenu-icon pe-7s-user"></i>
        Admins
    </a>
</li>
@endif
<li class="app-sidebar__heading">Application  MENU</li>
{{-- Users --}}
@if(Route::has('admin.users.index'))
<li class="">
    <a href="{{route('admin.users.index')}}" class="{{ Request::is('rt-admin/users**') ? 'mm-active' : '' }}">
        <i class="metismenu-icon pe-7s-users"></i>
        Users
    </a>
</li>
@endif

{{-- Contacts --}}
@if(Route::has('admin.contacts'))
<li class="">
    <a href="{{route('admin.contacts')}}" class="{{ Request::is('rt-admin/contact*') ? 'mm-active' : '' }}">
        <i class="metismenu-icon pe-7s-network"></i>
        Contacts
    </a>
</li>
@endif


{{-- Feedbacks --}}
@if(Route::has('admin.feedbacks'))
<li class="">
    <a href="{{route('admin.feedbacks')}}" class="{{ Request::is('rt-admin/feedback*') ? 'mm-active' : '' }}">
        <i class="metismenu-icon pe-7s-note2"></i>
        Feedbacks
    </a>
</li>
@endif
<li class="app-sidebar__heading">System Menu</li>
{{-- Backup --}}
<li class="">
    <a href="{{route('admin.backups.index')}}" class="{{ Request::is('rt-admin/backups**') ? 'mm-active' : '' }}">
        <i class="metismenu-icon pe-7s-cloud"></i>
        Backup
    </a>
</li>

<li class="">
    <a href="{{route('admin.settings.index')}}" class="{{ Request::is('rt-admin/settings**') ? 'mm-active' : '' }}">
        <i class="metismenu-icon pe-7s-settings"></i>
        Settings
    </a>
</li>

{{-- 
<li>
    <a href="#">
        <i class="metismenu-icon pe-7s-diamond"></i>
        Elements
        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
    </a>
    <ul>
        <li>
            <a href="elements-buttons-standard.html">
                <i class="metismenu-icon"></i>
                Buttons
            </a>
        </li>
        <li>
            <a href="elements-dropdowns.html">
                <i class="metismenu-icon">
                </i>Dropdowns
            </a>
        </li>
    </ul>
</li> --}}





<li class="">
    <a href="{{route('admin.employees.index')}}" class="{{ Request::is('rt-admin/employees**') ? 'mm-active' : '' }}">
        <i class="metismenu-icon pe-7s-menu"></i>
        Employees
    </a>
</li>

