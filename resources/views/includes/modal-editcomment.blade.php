<div class="modal fade" id="editModal{{ $comment->id }}" tabindex="-1" aria-labelledby="editModal{{ $comment->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form method="POST" action="{{ route('comments.update', $comment->id) }}">
          @csrf
          @method('PUT')
          <div class="modal-header">
            <h5 class="modal-title" id="editModal{{ $comment->id }}Label">Edit Comment</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            {{-- Comment --}}
            <div class="row mb-3">
                <label for="content" class="col-md-4 col-form-label text-md-end">{{ __('Comment') }}</label>
                <div class="col-md-6">
                    <input
                        id="content"
                        type="text"
                        class="form-control @error('content') is-invalid @enderror"
                        name="content"
                        value="{{ old('content', $comment->content) }}"
                    >
                    @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-dark">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
</div>