@extends('layouts.plane')

@section('body')
 <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

            @include('NAV_BAR.Title-bar')
            <!-- /.navbar-header -->

          @include('NAV_BAR.navbar_static_top')

            <!-- /.navbar-top-links -->

            @include('SIDEBAR.sidebar_default')
            <!-- /.navbar-static-side -->
        </nav>

          @include('PAGE_WRAPPER.page_wrapper')

    </div>
@stop

