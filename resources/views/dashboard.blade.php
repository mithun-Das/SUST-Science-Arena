@extends('layouts.default')
    @section('content')
        @include('includes.alert')
        <div class="wraper container-fluid">
            <div class="page-title"> 
                <h3 class="title">Welcome ! <i>{{ Auth::user()->name }}</i></h3> 
            </div>

            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="widget-panel widget-style-2 white-bg">
                        <i class="ion-android-contacts text-success"></i> 
                        <h2 class="m-0 counter">{{ $developerCount or '' }}</h2>
                        <div>Developers</div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget-panel widget-style-2 white-bg">
                        <i class="fa fa-folder text-purple"></i> 
                        <h2 class="m-0 counter">{{ $projectCount or '' }}</h2>
                        <div>Projects</div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget-panel widget-style-2 white-bg">
                        <i class="ion-ios7-pricetag text-info"></i> 
                        <h2 class="m-0 counter">1268</h2>
                        <div>New Orders</div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget-panel widget-style-2 white-bg">
                        <i class="ion-eye text-pink"></i> 
                        <h2 class="m-0 counter">145</h2>
                        <div>New Users</div>
                    </div>
                </div>
            </div> <!-- end row -->
        </div>
@stop