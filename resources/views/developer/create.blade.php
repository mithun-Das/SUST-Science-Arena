@extends('layouts.default')
@section('content')
    <div class="wraper container-fluid">

        @include('includes.alert')
        <!-- Masiur Rahman Siddiki -->
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-default">
                @if(!Auth::user()->hasRole('admin'))
                    Sorry, Boss. You do not have permission to add developer, rather you can recommend.
                @else
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                    <h4>{{ $title }}</h4>
                            </div>
                            <div class="col-md-6">                            
                                <a class="pull-right" href="{!! route('developer.index')!!}"><button class="btn btn-success">Developer List</button></a>
                            </div>
                         </div>
                    </div>

                    <div class="panel-body">
                            
                        <div class=" form"> 

                            {!! Form::open(array('route' => 'developer.store' , 'method' => 'post','class' => 'form-horizontal')) !!}

                            <div class="form-group">
                                {!! Form::label('name', "Developer Name*", array('class' => 'control-label col-lg-2')) !!}
                                <div class="col-lg-10">
                                    {!! Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Enter Developer Name', 'required' => 'required')) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('email', "Email Address*", array('class' => 'control-label col-lg-2')) !!}
                                <div class="col-lg-10">
                                    {!! Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'Email Address', 'autofocus')) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('password', "Password*", array('class' => 'control-label col-lg-2')) !!}
                                <div class="col-lg-10">
                                    {!! Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('password_confirmation', "Confirm Password*", array('class' => 'control-label col-lg-2')) !!}
                                <div class="col-lg-10">
                                    {!! Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => 'Confirm Password')) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                {!! Form::submit('Add Developer', array('class' => 'btn btn-success')) !!}
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                             
                    </div>
                @endif
                </div>

            </div>

        </div>

@stop
