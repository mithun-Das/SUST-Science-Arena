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
                                     <a class="pull-right" href="{!! route('developer.create')!!}"><button class="btn btn-success">Add developer</button></a>
                                </div>
                            </div>
                        </div>
                                                   
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                @if(count($developers))
                                    <table  id="dataTable" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>I</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            @role('admin')<th>Plain Password ( Admin View Only)</th>@endrole
                                            @role('admin')<th>#</th>
                                            <th>#</th>@endrole
                                        </tr>
                                        </thead>
                                        <tbody><?php $developerCount = 1 ?>
                                        @foreach ($developers as $developer)
                                            <tr> 
                                                <td>{!! $developerCount++ !!}</td>
                                                <td>{!! $developer->name !!}</td>
                                                <td>{!! $developer->email !!}</td>
                                                @role('admin')<td>{!! $developer->visiblePasskey !!}</td>@endrole
                                                <!-- <td><a class="btn btn-info btn-xs btn-archive Showbtn" href="{!!route('developer.show',$developer->id)!!}"  style="margin-right: 3px;">Show Details</a></td> -->
                                                @role('admin')<td class="text-center"><a class="btn btn-success btn-xs btn-archive Editbtn" href="{!!route('developer.edit',$developer->id)!!}"  style="margin-right: 3px;">Edit</a></td>
                                                <td class="text-center"><a href="#" class="btn btn-danger btn-xs btn-archive deleteBtn" data-toggle="modal" data-target="#deleteConfirm" deleteId="{!! $developer->id!!}">Delete</a></td>
                                                @endrole
                                            </tr>

                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    No developer added yet. Be first to add a developer
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                </div>
                <div class="modal-body">
                    Are you sure to delete?
                </div>
                <div class="modal-footer">
                    {!! Form::open(array('route' => array('developer.delete', 0), 'method'=> 'delete', 'class' => 'deleteForm')) !!}
                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                    {!! Form::submit('Yes, Delete', array('class' => 'btn btn-primary')) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

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
                var url = "<?php echo URL::route('developer.delete', false); ?>";
                $(".deleteForm").attr("action", url+'/'+deleteId);
            });

        });
    </script>


@stop







