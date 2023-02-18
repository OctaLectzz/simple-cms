<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('vendor/admin-lte/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light fs-5">Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (auth()->user()->images)
                    <img src="{{ asset('storage/images/' . Auth::user()->images) }}" class="img-circle elevation-2" alt="User Image">
                @else
                    <img src="{{ asset('vendor/admin-lte/img/user-profile-default.jpg') }}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="{{ route('my.profile.index') }}" class="d-block">{{ Auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


               {{-- Home --}}
               <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-home"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>

                {{-- All Users --}}
                {{-- <li class="nav-item">
                    <a href="{{ route('users') }}" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Users Info
                        </p>
                    </a>
                </li>  --}}

                {{-- Datatable Users --}}
                @if (Auth()->user()->role == "superAdmin")
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link {{ Request::is('user*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Users List
                        </p>
                    </a>
                </li>
                @endif

                {{-- Tags --}}
                {{-- <li class="nav-item dropdown">
                    <a href="{{ route('tag.index') }}" class="nav-link dropdown-toggle {{ Request::is('tag*') ? 'active' : '' }}" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="nav-icon fa fa-tags"></i>
                        <p>
                            Tags
                        </p>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{ route('tag.index') }}">List</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('tag.create') }}">Create</a></li>
                      </ul>
                </li> --}}
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link {{ Request::is('tag*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-tags"></i>
                        <p>
                            Tags
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ms-3">
                        <li class="nav-item">
                            <a href="{{ route('tag.index') }}" class="nav-link">
                            <i class="fa fa-list nav-icon"></i>
                            <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tag.create') }}" class="nav-link">
                            <i class="fa fa-file-signature nav-icon"></i>
                            <p>Create</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Category --}}
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link {{ Request::is('category*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-newspaper"></i>
                        <p>
                            Categories
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ms-3">
                        <li class="nav-item">
                            <a href="{{ route('category.index') }}" class="nav-link">
                            <i class="fa fa-list nav-icon"></i>
                            <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('category.create') }}" class="nav-link">
                            <i class="fa fa-file-signature nav-icon"></i>
                            <p>Create</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Post --}}
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link {{ Request::is('post*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-newspaper"></i>
                        <p>
                            Posts
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ms-3">
                        <li class="nav-item">
                            <a href="{{ route('post.index') }}" class="nav-link">
                            <i class="fa fa-list nav-icon"></i>
                            <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('post.create') }}" class="nav-link">
                            <i class="fa fa-file-signature nav-icon"></i>
                            <p>Create</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>