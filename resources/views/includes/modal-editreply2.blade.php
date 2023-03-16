<form class="add-comment" action="{{ route('comments.update', ['comment' => $reply2->id]) }}" method="POST" data-comment-id="{{ $reply2->id }}">
  @csrf
  @method('PUT')

  <div class="modal fade" id="editCommentModal{{ $reply2->id }}" tabindex="-1" aria-labelledby="editCommentModal{{ $reply2->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="editCommentModal{{ $reply2->id }}Label">Edit Comment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="editContent{{ $reply2->id }}" class="form-label">Comment :</label>
            <textarea name="content" id="editContent{{ $reply2->id }}" class="form-control" value="{{ old('content') }}" maxlength="255" required>{{ $reply2->content }}</textarea>
            @error('content')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="comment-button btn btn-dark">Save Changes</button>
        </div>

      </div>
    </div>
  </div>
  
</form>