@extends('layouts.default')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            @include('includes.alert')
            <div class="row">
                <div class="col-md-12">

                    <div class="panel panel-default">

                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>{{ $title }}</h4>
                                </div>
                                <div class="col-md-6">                            
                                     <a class="pull-right" href="{!! route('event.create') !!}"><button class="btn btn-success">Add Event</button></a>
                                </div>
                            </div>
                        </div>            
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                @if(count($events))
                                    <table  id="dataTable" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Event Name</th>
                                            <th>Details</th>
                                            <th>Date</th>
                                            <th>Place</th>
                                            <th>#</th>
                                            <th>#</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($events as $event)

                                            <tr>
                                                <td><?php echo $eventCounter++; ?></td>
                                                <td>
                                                    <a class="show-project-modal" data-toggle="modal" data-project-id="{{ $event->id }}" data-project-url="{!! route('event.show',$event->id) !!}" href="#" style="">{!! $event->name !!}</a>
                                                </td>
                                                <td>{!! $event->description !!}</td>
                                                <td>{!! $event->date !!}</td>
                                                <td>{!! $event->place !!}</td>
                                                <td><a class="btn btn-success btn-xs btn-archive Editbtn" href="{!! route('event.edit',$event->id)!!}"  style="margin-right: 3px;">Edit</a></td>
                                                <td><a href="#" class="btn btn-danger btn-xs btn-archive deleteBtn" data-toggle="modal" data-target="#deleteConfirm" deleteId="{!! $event->id !!}">Delete</a></td>
                                            </tr>
                                            
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    No event added yet. 
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@if(count($events))  
@include('sections.modals')  <!-- the two modals of this page  is kept in another folder for convenience  -->
@else
@endif

@stop

@section('style')

{!! Html::style('assets/datatables/jquery.dataTables.min.css') !!}

@endsection

@section('script')

    {!! Html::script('assets/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/datatables/dataTables.bootstrap.js') !!}




    <!-- for Datatable -->
    <script type="text/javascript">

        $(document).ready(function() {
            
            $('#dataTable').dataTable();

            $(document).on("click", ".deleteBtn", function() {
                var deleteId = $(this).attr('deleteId');
                var url = "<?php echo URL::route('event.index'); ?>";
                $(".deleteForm").attr("action", url+'/'+deleteId);
            });

            //triggered when modal is about to be shown
            // $('#showDetails').on('show.bs.modal', function(e) {

            //     //get data-id attribute of the clicked element
            //     var dataId = $(e.relatedTarget).data('data-id');

            //     //populate the textbox
            //     $(e.currentTarget).find('#data').val(dataId);
            // });
             $(document).on('click', '.show-project-modal', function(){
                    // get project -id from where the modal is called with data-project-id
                    var project = null;
                    var projectId = $(this).data('event-id');
                    var projectUrl = $(this).data('event-name');
                    var infoModal = $('#showDetails'); // modal id 
                    
                    // console.log(projectUrl);
                    // return;
                    // Ajax Call
                    $.ajax({
                        url : projectUrl,  // which url should be called to the backEnd , this url is generated from where the modal is called
                        
                        method : 'GET', 
                        dataType : 'json',
                        // result success or error below 
                        success : function(response){
                           
                            // var message = response.data.message;
                            // var success = '<div class="alert alert-success alert-dismissable fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+message+'</div>'
                            // this.span.html('');
                            // console.log(response);
                            project = response;
                            // return;
                            
                            // saveButtonReference.hide(500);
                            htmlData = '<p><b>Git Link:</b><br>'+response.git_link+'</p>'+
                                        '<p><b>Technical Description:</b><br>'+response.tech_description+'</p>'+
                                        '<p><b>Which Category?:</b><br>'+response.category.name+'</p>'+
                                        '<p><b>Built-in:</b><br>'; // assign html with expected value 
                            /* this function works like foreach loop first parameter is the array and second parameter within
                            function() is the variable to access the single value in that array */
                            $.each(response.language, function(index, singleLanguage){
                               htmlData += '<i>'+singleLanguage.name+'</i>,';  
                            });
                            htmlData += '</p><p><b>Developers:</b><br> ';
                            $.each(response.developer, function(index, singleDeveloper){
                               htmlData += '<i>'+singleDeveloper.name+'</i>,';
                               // console.log('a'); to check if the loop is working 
                            });
                            // htmlData += '</p><p><b>Supervisor:</b><br> ';
                            // $.each(response.supervisor, function(index, singleSupervisor){
                            //    htmlData += '<i>'+singleSupervisor.name+'</i>,';
                            // });
                            htmlData += '</p><p><b>Domain:</b><br>'+(response.details.domain != null ? response.details.domain : 'নাই') +'</p>'+
                                        '<p><b>Credentials:</b><br>'+(response.details.credentials != null? response.details.credentials : 'রাতুল ভাই জানে') +'</p>'+
                                        '<p><b>Full Description:</b><br>'+(response.details.description != null ? response.details.description : 'রাতুল ভাই জানে')+'</p>'+
                                        '<p><b>Dependency:</b><br>'+(response.details.dependency != null ? response.details.dependency : 'রাতুল ভাই জানে') +'</p>'+
                                        '<p><b>Dependent Project:</b><br>'+(response.details.dependent_pro_id != null ? response.details.dependent_pro_id : 'রাতুল ভাই জানে') +'</p>'+
                                        '<p><b>Database Backup:</b><br><a href="'+(response.details.db_backup != null ? response.details.db_backup : 'রাতুল ভাই জানে') +'"><button class="btn btn-info">Download</button></a></p>';
                            infoModal.find('.modal-body').html(htmlData);
                            infoModal.find('.modal-title').html(response.name);
                            $('#showDetails').modal('toggle');
                            $('#error').html('');
                        
                        },
                        error : function(errorResponse){
                           
                            var messages = jQuery.parseJSON(errorResponse.responseText);
                            console.log(messages);
                          
                        }
                    });
                    // Ajax Call End 

                    return false;

            });
                // these above code concept line was borrowed from legaats project which was done by Mr. Md. Nayeem Iqubal Joy. Also , he helped dubugging it. 
        });
    </script>


@stop
