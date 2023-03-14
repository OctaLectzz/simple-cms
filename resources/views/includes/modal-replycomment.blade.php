<form action="{{ route('comments.reply', ['comment' => $comment->id]) }}" method="POST" data-comment-id="{{ $comment->id }}">
    @csrf

    <div class="modal fade" id="replyModal{{ $comment->id }}" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="replyCommentModal{{ $comment->id }}Label">Reply to <i>{{ $comment->user->name }}</i></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                    <div class="form-group">
                        <textarea name="content" id="replyaContent{{ $comment->id }}" class="form-control" rows="2" required></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark" id="comment-button">Kirim</button>
                </div>

            </div>
        </div>
    </div>

</form>