<div class="modal fade" id='modal-comment'>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Signaler un commentaire</h4>
      </div>
      <div class="modal-body modal-comment-user">
         {{ Form::open(array('route' => array('comment.report', $comment->id,"test"),'class' => 'form-comment-report')) }}
         <div class="comment-modal-content"></div>
         <label for="message-text" class="control-label">Pourquoi signaler ce commentaire ?</label>
         <textarea class="form-control" id="message-text"></textarea>
         {{ Form::close() }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-danger btn-comment-report">Signaler</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 
