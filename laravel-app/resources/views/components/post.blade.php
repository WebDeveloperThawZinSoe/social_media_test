@foreach($posts as $post)
<div class="card p-3">
  <div class="post-header">
    <img src="{{ $post->user->getProfilePhotoUrlAttribute() }}" class="post-avatar">
    <div>
      <strong>{{ $post->user->name }}</strong><br>
      <span class="post-meta">{{ $post->created_at->diffForHumans() }}</span>
    </div>
  </div>

  <p class="mt-2">{{ $post->text }}</p>

    @if($post->media_url)
    @if($post->media_type === 'image')
        <img src="{{ asset(ltrim($post->media_url, '/')) }}" class="img-fluid post-img">
    @elseif($post->media_type === 'video')
        <video controls class="w-100 mt-2 rounded">
        <source src="{{ asset(ltrim($post->media_url, '/')) }}" type="video/mp4">
        Your browser does not support the video tag.
        </video>
    @endif
    @endif

    <div class="d-flex justify-content-between mt-3">
        <div class="post-actions">
            <span class="react-btn" data-id="{{ $post->id }}">
                <i class="bi {{ $post->getIsReactedAttribute() ? 'bi-heart-fill text-danger' : 'bi-heart' }}"></i>
                <span class="react-count">{{ $post->getReactCountAttribute() }}</span>
            </span>
            <span><i class="bi bi-chat"></i> 0</span>
        </div>
    </div>



  <input type="text" class="form-control comment-box mt-2" placeholder="Write a comment...">
</div>

@endforeach

@push('scripts')
<script>
let page = 1;
let loading = false;
let noMorePosts = false;

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

    fetch(`?page=${page}`, {
        headers: { "X-Requested-With": "XMLHttpRequest" }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('loading').style.display = 'none';
        loading = false;

        if (data.done) {
            noMorePosts = true;
            if (!document.getElementById('no-more-posts')) {
                const msg = document.createElement('div');
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
            // Update the react count
            countEl.textContent = data.count;

            if (data.liked) {
                // Switch to filled red heart
                icon.classList.remove('bi-heart');
                icon.classList.add('bi-heart-fill', 'text-danger');
            } else {
                // Switch back to outline heart
                icon.classList.remove('bi-heart-fill', 'text-danger');
                icon.classList.add('bi-heart');
            }
        })
        .catch(err => console.error(err));
    }
});

</script>
@endpush
