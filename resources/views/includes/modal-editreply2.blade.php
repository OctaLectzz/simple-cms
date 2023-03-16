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
            <textarea name="content" id="editContent{{ $reply2->id }}" class="form-control" value="{{ old('content') }}" oninput="limitTextArea(this, 255, {{ $reply2->id }})" maxlength="255" required>{{ $reply2->content }}</textarea>
            <small class="text-muted fst-italic ms-1" id="replyCharsLeft{{ $reply2->id }}">255</small>
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


<script>
  function limitTextArea(textArea, maxLength, commentId) {
    if (textArea.value.length > maxLength) {
        textArea.value = textArea.value.slice(0, maxLength);
    }
    document.getElementById("replyCharsLeft" + commentId).innerHTML = maxLength - textArea.value.length;
  }
</script>