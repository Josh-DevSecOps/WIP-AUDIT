<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                </div>
                <!-- /input-group -->
            </li>


            <li {{ (Request::is('/') ? 'class="active"' : '') }}>
                <a href="{{ url ('/') }}"><i class="fa fa-dashboard fa-fw"></i> HOME </a>
            </li>

            <li>
                <a href="/"><i class="fa fa-folder-open"></i> RISK ASSESSMENT<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="experience">NEW EXPERIENCE</a>
                    </li>
                    <li>
                        <a href="#"> ALL EXPERIENCES </a>
                    </li>
                    <li>
                        <a href="#"> RISK MAPPING <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">

                            <li>
                               <a href="{{ url ('chartProtocoles') }}"><i class="fa fa-sitemap fa-fw"></i> CHARTS-PROTOCOLS </a>

                            </li>
                            <li>
                                <!--<a href="#">THREATS</a>-->
                                <a href="{{ url ('chartjs') }}"><i class="fa fa-exclamation-triangle"></i> CHARTS-THREATS </a>

                            </li>
                            <li>
                                <a href="{{ url ('chartVulnerabilites') }}"><i class="fa fa-filter"></i> CHARTS-VULNERABILITIES </a>


                            </li>

                        </ul>
                        <!-- /.nav-third-level -->
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>


            <!--  EXPERIENCES -->
        {{--<li {{ (Request::is('/') ? 'class="active"' : '') }}>
            <a href="{{ url ('') }}"><i class="fa fa-folder-open"></i> RISK ASSESSMENT </a>
        </li> --}}

        <!--  risk status -->
            <li {{ (Request::is('/') ? 'class="active"' : '') }}>
                <a href="{{ url('StatusRisks') }}"><i class="fa fa-sitemap fa-fw"></i> RISK STATUS </a>
            </li>
            <!--  Protocols -->
            <li {{ (Request::is('/') ? 'class="active"' : '') }}>
                <a href="{{ url('Protocoles') }}"><i class="fa fa-sitemap fa-fw"></i> PROTOCOLS </a>
            </li>
            <!--  Menaces -->
            <li {{ (Request::is('/') ? 'class="active"' : '') }}>
            <a href="{{ url ('Menaces') }}"><i class="fa fa-exclamation-triangle"></i> THREATS </a>
            </li>

            <!---test chartjs -->
        <!---  <li {{ (Request::is('/') ? 'class="active"' : '') }}>
            <a href="{{ url ('chartjs') }}"><i class="fa fa-exclamation-triangle"></i> CHARTSJS </a>
            </li>-->

            <!---end test chartjs -->



            <!--  Vulnerabilites -->
            <li {{ (Request::is('/') ? 'class="active"' : '') }}>
                <a href="{{ url ('Vulnerabilites') }}"><i class="fa fa-filter"></i> VULNERABILITY </a>
            </li>



            {{--          @include('SIDEBAR.sidebar_other')   --}}


            <li {{ (Request::is('/') ? 'class="active"' : '') }}>
                <a href="{{ url ('#') }}"><i class="fa fa-file-word-o fa-fw"></i> Documentation</a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>