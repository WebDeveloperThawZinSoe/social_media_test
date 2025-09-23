<div class="d-flex align-items-start mb-3 mt-4 comment-item border-bottom pb-2" data-id="{{ $comment->id }}">
    <img src="{{ $comment->user->profile_photo_url ?? asset('default-avatar.png') }}"
         class="rounded-circle shadow-sm me-3"
         style="width:40px;height:40px;object-fit:cover;">
    <div class="flex-grow-1">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <div>
                <strong class="text-dark">{{ $comment->user->name }}</strong>
                <span class="text-muted small ms-2">{{ $comment->created_at->diffForHumans() }}</span>
            </div>

            @if(auth()->id() === $comment->user_id)
                <form action="{{ route('comment.delete', $comment->id) }}" method="POST" 
                      onsubmit="return confirm('Are you sure you want to delete this comment?')" 
                      class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="btn btn-sm btn-light text-danger rounded-circle shadow-sm"
                            title="Delete Comment">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            @endif
        </div>

        <div class="bg-light p-2 rounded-3 shadow-sm text-dark">
            {{ $comment->comment }}
        </div>
    </div>
</div>
