<div id="post-container">
    @foreach($posts as $post)
        <div class="card p-3 mt-4">
            <div class="post-header d-flex align-items-center">
                <img src="{{ $post->user->profile_photo_url ?? asset('default-avatar.png') }}" 
                     class="post-avatar rounded-circle me-2">

                <div>
                    <strong>
                        <a href="{{ route('other_profile',$post->user->user_url) }}">{{ $post->user->name }}</a>
                    </strong><br>
                    <span class="post-meta text-muted small">{{ $post->created_at->diffForHumans() }}</span>
                </div>

                @if(auth()->id() === $post->user_id)
                    <button type="button"
                            class="btn btn-link text-danger p-0 ms-auto"
                            data-bs-toggle="modal"
                            data-bs-target="#deletePostModal"
                            data-id="{{ $post->id }}">
                        <i class="bi bi-trash3-fill fs-5"></i>
                    </button>
                @endif
            </div>

            <p class="mt-2 mb-2">{{ $post->text }}</p>

            @if($post->media_url)
                @if($post->media_type === 'image')
                    <img src="{{ asset(ltrim($post->media_url, '/')) }}" class="img-fluid post-img rounded">
                @elseif($post->media_type === 'video')
                    <video controls class="w-100 mt-2 rounded">
                        <source src="{{ asset(ltrim($post->media_url, '/')) }}" type="video/mp4">
                    </video>
                @endif
            @endif

            <div class="d-flex justify-content-between mt-3">
                <div class="post-actions">
                    <span class="react-btn" data-id="{{ $post->id }}">
                        <i class="bi {{ $post->isReacted ? 'bi-heart-fill text-danger' : 'bi-heart' }}"></i>
                        <span class="react-count">{{ $post->reactCount }}</span>
                    </span>
                    <span class="ms-3"><i class="bi bi-chat"></i> 0</span>
                </div>
            </div>

            <input type="text" class="form-control comment-box mt-2" placeholder="Write a comment...">
        </div>
    @endforeach
</div>

<div id="loading" class="text-center my-3" style="display:none;">
    <div class="spinner-border text-primary" role="status"></div>
</div>

<!-- Delete Post Modal -->
<div class="modal fade" id="deletePostModal" tabindex="-1" aria-labelledby="deletePostModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="deletePostModalLabel">
          <i class="bi bi-exclamation-triangle me-2"></i> Confirm Delete
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <p>Are you sure you want to delete this post? This action cannot be undone.</p>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form id="deletePostForm" method="POST" class="d-inline">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // delete model box

    const deleteModal = document.getElementById('deletePostModal');
    const deleteForm = document.getElementById('deletePostForm');

    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const postId = button.getAttribute('data-id');
        deleteForm.action = "/post/" + postId + "/delete";
    });

    // scroll post
    let page = 1, loading = false, noMorePosts = false;
    window.addEventListener('scroll', () => {
        if (loading || noMorePosts) return;
        let scrollTop = window.scrollY;
        let windowHeight = window.innerHeight;
        let documentHeight = document.body.scrollHeight;

        if (scrollTop + windowHeight + 200 >= documentHeight) {
            loadMore();
        }
    });

    function loadMore() {
        loading = true;
        page++;
        document.getElementById('loading').style.display = 'block';

        fetch(`/?page=${page}`, { headers: { "X-Requested-With": "XMLHttpRequest" } })
        .then(res => res.json())
        .then(data => {
            document.getElementById('loading').style.display = 'none';
            loading = false;
            if (data.done) {
                noMorePosts = true;
                if (!document.getElementById('no-more-posts')) {
                    let msg = document.createElement('div');
                    msg.id = 'no-more-posts';
                    msg.className = 'text-center text-muted my-3';
                    msg.innerText = '-- No more posts --';
                    document.getElementById('post-container').appendChild(msg);
                }
            } else {
                document.getElementById('post-container').insertAdjacentHTML('beforeend', data.html);
            }
        })
        .catch(() => {
            document.getElementById('loading').style.display = 'none';
            loading = false;
        });
    }

    // react toggle
    document.addEventListener('click', function(e) {
        if (e.target.closest('.react-btn')) {
            let btn = e.target.closest('.react-btn');
            let postId = btn.dataset.id;
            let countEl = btn.querySelector('.react-count');
            let icon = btn.querySelector('i');

            fetch("{{ route('react.toggle') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ post_id: postId })
            })
            .then(res => res.json())
            .then(data => {
                countEl.textContent = data.count;
                if (data.liked) {
                    icon.classList.remove('bi-heart');
                    icon.classList.add('bi-heart-fill', 'text-danger');
                } else {
                    icon.classList.remove('bi-heart-fill', 'text-danger');
                    icon.classList.add('bi-heart');
                }
            })
            .catch(err => console.error(err));
        }
    });
});
</script>
@endpush
