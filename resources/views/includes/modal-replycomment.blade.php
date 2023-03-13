<div class="modal fade" id="replyModal{{ $comment->id }}" tabindex="-1" aria-labelledby="replyModalLabel{{ $comment->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="replyModalLabel{{ $comment->id }}">Balas Komentar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('comments.store') }}" method="POST">
                @csrf

                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <input type="hidden" name="parent_id" value="{{ $comment->id }}">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="content">Komentar:</label>
                        <textarea name="content" id="content" class="form-control"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Tutup</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>

        </div>
    </div>
</div>