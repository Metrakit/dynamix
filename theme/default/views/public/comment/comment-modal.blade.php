{{ Form::open(array('route' => 'comment.report','class' => 'form-comment-report')) }}
  <div class="modal fade" id='modal-comment'>
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Signaler un commentaire </h4>
        </div>
        <div class="modal-body modal-comment-user">
           <div class="comment-modal-content"></div>
           <label for="message-text" class="control-label">Pourquoi signaler ce commentaire ?</label>
           <textarea class="form-control" name ="message" id="message-text"></textarea>
           <input id="comment-report-id" type="hidden" name="comment-report-id"/>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
          <button type="submit" class="btn btn-danger btn-comment-report">Signaler</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal --> 
  {{ Form::close() }}
