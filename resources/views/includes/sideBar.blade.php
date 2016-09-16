 <!-- Aside Start-->
<aside class="left-panel">

            <!-- brand -->
            <div class="logo">
                <a href="#" class="logo-expanded">
                    <i class="ion-social-buffer"></i>
                    <span href="{!!url('dashboard')!!}" class="nav-label" style="font-size: 16px;">{!! Config::get('customConfig.names.siteName')!!}</span>

                </a>
            </div>
            <!-- / brand -->


            <!-- Navbar Start -->
            <nav class="navigation">
                <ul class="list-unstyled">

                     <li class="{!! Menu::isActiveRoute('dashboard') !!}"><a href="{!!  URL::route( 'dashboard') !!}"><i class="ion-flask"></i> <span class="nav-label">Dashboard</span></a>
                       
                    </li>

                    <li class="{!! Menu::isActiveRoute('category.index') !!}"><a href="{{ route('category.index') }}"><i class="ion-grid"></i> <span class="nav-label">Category</span></a>
                       
                    </li>


                    <li class="{!! Menu::isActiveRoute('language.index') !!}"><a href="{{ route('language.index') }}"><i class="ion-compose"></i> <span class="nav-label">Language</span></a>
                     
                    </li>


                    <li class="{!! Menu::isActiveRoute('project.index') !!}"><a href="{{ route('project.index') }}"><i class="ion-stats-bars"></i> <span class="nav-label">Project</span><!-- <span class="badge bg-purple">1</span> --></a>
                       
                    </li>

                    @role('admin')<li class="{!! Menu::isActiveRoute('developer.index') !!}"><a href="{{ route('developer.index') }}"><i class="ion-compose"></i> <span class="nav-label">Developers</span><!-- <span class="badge bg-purple">1</span> --></a>
                
                    </li>
                    @endrole

                    @if(!Auth::user()->hasRole('admin'))
                    <li class="{!! Menu::isActiveRoute('developer.indexForDev') !!}"><a href="{{ route('developer.indexForDev') }}"><i class="ion-compose"></i> <span class="nav-label">Developers</span><!-- <span class="badge bg-purple">1</span> --></a>
                    </li>
                    @endif

                    <!-- <li class="has-submenu"><a href="#"><i class="ion-email"></i> <span class="nav-label">Mail</span></a>
                        <ul class="list-unstyled">
                            <li><a href="#">Inbox</a></li>
                            <li><a href="#">Compose Mail</a></li>
                            <li><a href="#">View Mail</a></li>

                        </ul>
                    </li>


                    <li class="has-submenu"><a href="#"><i class="ion-location"></i> <span class="nav-label">Maps</span></a>
                        <ul class="list-unstyled">
                            <li><a href="gmap.html"> Google Map</a></li>
                            <li><a href="vector-map.html"> Vector Map</a></li>
                        </ul>
                    </li> -->

                </ul>
            </nav>



</aside>
        <!-- Aside Ends-->



