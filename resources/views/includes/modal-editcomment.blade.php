<form action="{{ route('comments.update', ['comment' => $comment->id]) }}" method="POST" data-comment-id="{{ $comment->id }}" id="edit-comment">
  @csrf
  @method('PUT')

  <div class="modal fade" id="editCommentModal{{ $comment->id }}" tabindex="-1" aria-labelledby="editCommentModal{{ $comment->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="editCommentModal{{ $comment->id }}Label">Edit Comment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="editContent{{ $comment->id }}" class="form-label">Comment :</label>
            <textarea name="content" id="editContent{{ $comment->id }}" class="form-control" value="{{ old('content') }}" required>{{ $comment->content }}</textarea>
            @error('content')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-dark" id="edit-button">Save Changes</button>
        </div>

      </div>
    </div>
  </div>
  
</form>
