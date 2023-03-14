@foreach ($comment->replies as $key => $reply)

<div class="row mt-2 {{ $key < 2 && $key >= 1 ? 'ms-5' : 'ms-4' }}">
    <div class="col-md-1">
        <img src="{{ $reply->images }}" alt="User Avatar" class="rounded rounded-circle p-1 mb-2" width="40" height="40" style="border: 1px rgb(155, 155, 155) solid">
    </div>

    <div class="col-md-10">
        <div class="p-2 w-100 rounded-3" style="background-color: #e2e2e2">
            {{-- Dropdown --}}
            <div class="dropdown float-end">
                @if(auth()->check() && auth()->user()->id == $reply->user_id)
                    <button class="btn btn-default dropdown-toggle-no-arrow" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li>
                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editCommentModal{{ $reply['id'] }}"><i class="bi bi-pencil me-1"></i> Edit Comment</button>
                        </li>
                        <hr class="dropdown-divider">
                        <li>
                            <form onsubmit="destroy(event)" action="{{ route('comments.destroy', $reply->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item"><i class="bi bi-trash me-1"></i> Delete Comment</button>
                            </form>
                        </li>
                    </ul>
                @endif
            </div>
                
            <h6 class="fw-bold">{{ $reply->user->name }}</h6>

            <p class="card-text mb-1">{{ $reply->content }}</p>

            @if (auth()->check() && $key < 2 && $comment->replies->count() < 2)
                <button class="badge bg-dark" data-toggle="modal" data-target="#replyModal{{ $comment->id }}" data-bs-toggle="modal" data-bs-target="#replyModal{{ $comment->id }}">Reply</button>
            @endif

            @if (auth()->check() && $key < 2 && $comment->replies->count() < 2)
                <small class="text-muted float-end">{{ $post->created_at->diffForHumans() }}</small>
            @else
                <small class="text-muted d-flex justify-content-end">{{ $post->created_at->diffForHumans() }}</small>
            @endif
        </div>
    </div>

    @include('includes.modal-editreply')

</div>

@endforeach