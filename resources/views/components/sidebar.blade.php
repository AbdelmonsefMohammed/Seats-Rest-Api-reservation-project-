<!-- start sidebar menu -->
<div class="sidebar-container">
    <div class="sidemenu-container navbar-collapse collapse fixed-menu">
        <div id="remove-scroll">
            <ul class="sidemenu page-header-fixed p-t-20" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                <li class="sidebar-toggler-wrapper hide">
                    <div class="sidebar-toggler">
                        <span></span>
                    </div>
                </li>
                <li class="sidebar-user-panel">
                    <div class="user-panel">
                        <div class="row">
                                <div class="sidebar-userpic">
                                    <img src="assets/img/dp.jpg" class="img-responsive" alt=""> </div>
                            </div>
                            <div class="profile-usertitle">
                                <div class="sidebar-userpic-name"> John Deo </div>
                                <div class="profile-usertitle-job"> Manager </div>
                            </div>
                            <div class="sidebar-userpic-btn">
                                <a class="tooltips" href="user_profile.html" data-placement="top" data-original-title="Profile">
                                    <i class="material-icons">person_outline</i>
                                </a>
                                <a class="tooltips" href="email_inbox.html" data-placement="top" data-original-title="Mail">
                                    <i class="material-icons">mail_outline</i>
                                </a>
                                <a class="tooltips" href="chat.html" data-placement="top" data-original-title="Chat">
                                    <i class="material-icons">chat</i>
                                </a>
                                <a class="tooltips" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" data-placement="top" data-original-title="Logout">
                                    <i class="material-icons">input</i>
                                </a>
                            </div>
                    </div>
                </li>
                <li class="menu-heading">
                    <span>-- Main</span>
                </li>
                <li class="nav-item start">
                    <a href="#" class="nav-link nav-toggle">
                        <i class="material-icons">dashboard</i>
                        <span class="title">Dashboard</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="index.html" class="nav-link ">
                                <span class="title">Dashboard 1</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('dashboard.categories.index')}}" class="nav-link nav-toggle"> <i class="material-icons">widgets</i>
                        <span class="title">Categories</span> 
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle"> <i class="material-icons">desktop_mac</i>
                        <span class="title">Users</span> <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="{{route('dashboard.customers.index')}}" class="nav-link "> <span class="title">Customers</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="layout_full_width.html" class="nav-link "> <span class="title">Full Width</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-heading m-t-20">
                    <span>Restaurants &amp; Branches</span>
                </li>
                <li class="nav-item">
                    <a href="{{route('dashboard.restaurants.index')}}" class="nav-link nav-toggle"> <i class="material-icons">widgets</i>
                        <span class="title">Restaurants</span> 
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('dashboard.branches.index')}}" class="nav-link nav-toggle"> <i class="material-icons">widgets</i>
                        <span class="title">Branches</span> 
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle"> <i class="material-icons">grain</i>
                        <span class="title">Apps</span> <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="chat.html" class="nav-link "> <span class="title">Chat</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="contact_list.html" class="nav-link "> <span class="title">Contact List</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="contact_grid.html" class="nav-link "> <span class="title">Contact Grid</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="gallery.html" class="nav-link "> <span class="title">Gallery</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="support.html" class="nav-link "> <span class="title">Support</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="calendar.html" class="nav-link "> <span class="title">Calendar</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- end sidebar menu -->