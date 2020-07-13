<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('back.main')}}" class="brand-link">
        <img src="{{session()->get('w')->logo}}" alt="{{session()->get('w')->name}} Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">{{session()->get('w')->name}}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('back.main')}}" class="nav-link @if("http" . (($_SERVER['SERVER_PORT'] == 443) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] == route('back.main'))
                            active
                            @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview
                @if(strpos("http" . (($_SERVER['SERVER_PORT'] == 443) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],'job') !== false)
                        menu-open
                @endif">
                    <a href="#" class="nav-link
                    @if(strpos("http" . (($_SERVER['SERVER_PORT'] == 443) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],'job') !== false)
                            active
                    @endif">
                        <i class="nav-icon fas fa-industry"></i>
                        <p>
                            Jobs
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('job.index')}}" class="nav-link
                            @if("http" . (($_SERVER['SERVER_PORT'] == 443) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] == route('job.index'))
                                    active
                            @endif">
                                <i class="far fa-eye nav-icon"></i>
                                <p>View</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('job.create')}}" class="nav-link
                            @if("http" . (($_SERVER['SERVER_PORT'] == 443) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] == route('job.create'))
                                    active
                            @endif">
                                <i class="fa fa-pen nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('company.index')}}" class="nav-link @if("http" . (($_SERVER['SERVER_PORT'] == 443) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] == route('company.index'))
                            active
                        @endif">
                        <i class="fa fa-building nav-icon"></i>
                        <p>
                            Companies
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('testimonial.index')}}" class="nav-link @if("http" . (($_SERVER['SERVER_PORT'] == 443) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] == route('testimonial.index'))
                            active
                            @endif">
                        <i class="fa fa-quote-left nav-icon"></i>

                        <p>
                            Testimonials
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('applications.index')}}" class="nav-link @if("http" . (($_SERVER['SERVER_PORT'] == 443) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] == route('applications.index'))
                            active
                            @endif">
                        <i class="fa fa-briefcase nav-icon"></i>

                        <p>
                            Applications
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('field.index')}}" class="nav-link @if("http" . (($_SERVER['SERVER_PORT'] == 443) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] == route('field.index'))
                            active
                        @endif">
                        <i class="fa fa-list-alt nav-icon"></i>

                        <p>
                            Fields
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('requirement.index')}}" class="nav-link @if("http" . (($_SERVER['SERVER_PORT'] == 443) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] == route('requirement.index'))
                            active
                            @endif">
                        <i class="fa fa-asterisk nav-icon"></i>

                        <p>
                            Requirements
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('skill.index')}}" class="nav-link @if("http" . (($_SERVER['SERVER_PORT'] == 443) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] == route('skill.index'))
                            active
                            @endif">
                        <i class="fa fa-brain nav-icon"></i>

                        <p>
                            Skills
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('app.index')}}" class="nav-link @if("http" . (($_SERVER['SERVER_PORT'] == 443) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] == route('app.index'))
                            active
                            @endif">
                        <i class="fa fa-cog nav-icon"></i>
                        <p>
                            App Settings
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{session()->get('w')->logo}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
    </div>
    <!-- /.sidebar -->
</aside>