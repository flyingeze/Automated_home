<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        <a href="{{ route('home') }}"><img src="{{ asset('/') }}assets/images/logo.svg" width="25" alt="Aero"><span class="m-l-10">Automated Home</span></a>
    </div>
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    <a class="image" href="{{ route('profile') }}"><img src="{{ asset('/') }}assets/images/profile_av.jpg" alt="User"></a>
                    <div class="detail">
                        <h4>@{{ currentUser.name }}</h4>
                        <small> @{{ currentUser.role }} </small>                        
                    </div>
                </div>
            </li>
            <li><a href="{{ route('home') }}"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>
            <li><a href="{{ route('profile') }}"><i class="zmdi zmdi-account"></i><span>My Profile</span></a></li>

            <li ng-if="currentUser.role == 'member'"><a href="{{ route('user.sections') }}"><i class="zmdi zmdi-apps"></i><span>My Sections</span></a></li>
            <li ng-if="currentUser.role == 'member'"><a href="{{ route('user.items') }}"><i class="zmdi zmdi-delicious"></i><span>My Items</span></a></li>

            @if(auth()->user()->role != 'member')
            <li>
                <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-apps"></i><span>My Home</span></a>
                <ul class="ml-menu">
                    <li><a href="{{ route('admin.sectionGroups')}}">Sections Group</a></li> 
                    <li><a href="{{ route('admin.sections')}}">Sections</a></li>                  
                </ul>
            </li>           
            <li>
                <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-delicious"></i><span>Widgets</span></a>
                <ul class="ml-menu">
                    <li><a href="{{ route('admin.itemGroup') }}">Home Items Group</a></li>
                    <li><a href="{{ route('admin.items') }}">Home Items</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-lock"></i><span>Authorization</span></a>
                <ul class="ml-menu">
                    <li><a href="{{ route('admin.users') }}">Users</a></li>
                </ul>
            </li>
            <li><a href="{{ route('admin.setting') }}"><i class="zmdi zmdi-flower"></i><span>Home Setting</span></a></li>
            @endif
            
            <li>
                <div class="progress-container progress-primary m-t-10">
                    <span class="progress-badge">Traffic this Month</span>
                    <div class="progress">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100" style="width: 67%;">
                            <span class="progress-value">67%</span>
                        </div>
                    </div>
                </div>
                <div class="progress-container progress-info">
                    <span class="progress-badge">Server Load</span>
                    <div class="progress">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="86" aria-valuemin="0" aria-valuemax="100" style="width: 86%;">
                            <span class="progress-value">86%</span>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</aside>