@extends('layouts.default')
@section('content')
    <div class="wraper container-fluid">

        @include('includes.alert')
        
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-default">
                @if(!Auth::user()->hasRole('admin'))
                    <b style="color:red">What the *** !! Do you have any idea what you wanted to do ??</b>
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

                            {!! Form::model($developer, array('route' => ['developer.update',$developer->id], 'method' => 'PUT', 'class' => 'form-horizontal')) !!}


                            <div class="form-group">
                                {!! Form::label('name', "Developer Name*", array('class' => 'control-label col-lg-2')) !!}
                                <div class="col-lg-10">
                                    {!! Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Enter Developer Name', 'required' => 'required')) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('email', "Email Address*", array('class' => 'control-label col-lg-2')) !!}
                                <div class="col-lg-10">
                                    {!! Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'Email Address', 'autofocus')) !!}
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
                                {!! Form::submit('Save Changes', array('class' => 'btn btn-success')) !!}
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


@section('style')

    {!! Html::style('assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css') !!}
    {!! Html::style('assets/summernote/summernote.css') !!}
@stop

@section('script')

    {!! Html::script('assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js') !!}
    {!! Html::script('assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js') !!}
    {!! Html::script('assets/summernote/summernote.min.js') !!}


    {!! Html::script('assets/jquery.validate/jquery.validate.min.js') !!}
    {!! Html::script('assets/jquery.validate/form-validation-init.js') !!}



    <!-- for editor-->
    <script type="text/javascript">
/*
       CREDENTIALS

USERNAME (API KEY):
4c541b6c03782a11336f320094872e40
PASSWORD (SECRET KEY):
1ef2b2c2448fc812bf9b1d3844b78ea5
SMTP SERVER:
in-v3.mailjet.com
PORT:
25 or 587 (some providers block port 25)
USE TLS:
optional
If TLS on port 587 doesn't work, try using port 465 and/or using SSL instead */
    </script>


@stop