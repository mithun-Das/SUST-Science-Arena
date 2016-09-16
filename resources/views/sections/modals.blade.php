<!-- Project Details  show Modal -->
<div class="modal fade" id="showDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"> </h4>
            </div> 
            <div class="modal-body">
                
                
            </div>
            <div class="modal-footer">
          
                <a href="#" class="btn btn-info" data-dismiss="modal" >Close</a>
            </div>
        </div>
    </div>
</div>


<!-- Project Delete Modal -->
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
                {!! Form::open(array('route' => array('project.delete', 0), 'method'=> 'delete', 'class' => 'deleteForm')) !!}
                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                {!! Form::submit('Yes, Delete', array('class' => 'btn btn-success')) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>