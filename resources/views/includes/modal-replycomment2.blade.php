<form class="add-comment" action="{{ route('comments.reply', ['comment' => $reply->id]) }}" method="POST" data-comment-id="{{ $reply->id }}">
    @csrf

    <div class="modal fade" id="replyModal{{ $reply->id }}" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="replyCommentModal{{ $reply->id }}Label">Reply to <i>{{ $reply->user->name }}</i></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <input type="hidden" name="comment_id" value="{{ $reply->id }}">
                    <div class="form-group">
                        <textarea name="content" id="replyaContent{{ $reply->id }}" class="form-control" rows="2" oninput="limitTextArea(this, 255, {{ $reply->id }})" maxlength="255" required></textarea>
                        <small class="text-muted fst-italic ms-1" id="replyCharsLeft{{ $reply->id }}">255</small> <small class="text-muted fst-italic">Character Left</small>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="comment-button btn btn-dark">Kirim</button>
                </div>

            </div>
        </div>
    </div>

</form>


<script>
    function limitTextArea(textArea, maxLength, replyId) {
        if (textArea.value.length > maxLength) {
            textArea.value = textArea.value.slice(0, maxLength);
        }
        document.getElementById("replyCharsLeft" + replyId).innerHTML = maxLength - textArea.value.length;
    }
</script>