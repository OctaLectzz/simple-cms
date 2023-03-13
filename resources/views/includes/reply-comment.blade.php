@foreach($comment->replies as $reply)

<div class="ms-4">
    <hr>
        {{-- Dropdown --}}
        <div class="dropdown float-end">
            @if(auth()->check() && auth()->user()->id == $comment->user_id)
                <button class="btn btn-default dropdown-toggle-no-arrow" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li>
                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editCommentModal{{ $comment['id'] }}"><i class="bi bi-pencil me-1"></i> Edit Comment</button>
                    </li>
                    <hr class="dropdown-divider">
                    <li>
                        <form onsubmit="destroy(event)" action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item"><i class="bi bi-trash me-1"></i> Delete Comment</button>
                        </form>
                    </li>
                </ul>
            @endif
        </div>
        <div class="row">
            <div class="col-md-1">
                <img src="{{ $comment->images }}" alt="User Avatar" class="rounded rounded-circle p-1 mb-2" width="40" height="40" style="border: 1px rgb(155, 155, 155) solid">
            </div>
            <div class="col-md-8">
                <h6 class="card-title d-inline-block">{{ $reply->user->name }}</h6>
                <p class="card-text">{{ $reply->content }}</p>
            </div>
        </div>
</div>

@endforeach