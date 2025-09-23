  <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data" class="card composer p-3">
      @csrf
      <h6 class="fw-bold mb-2">Create a post</h6>


      @error('post')
          <div class="alert alert-danger py-1 px-2 mb-2 small">{{ $message }}</div>
      @enderror

      <textarea id="postContent" name="text" class="form-control mb-2 @error('text') is-invalid @enderror" 
          rows="3" placeholder="What's happening in your world?" maxlength="500">{{ old('text') }}</textarea>
      @error('text')
          <div class="text-danger small">{{ $message }}</div>
      @enderror

      <div class="d-flex justify-content-between align-items-center mb-2">
          <div class="d-flex gap-2">
              <!-- Image -->
              <input type="file" id="imageInput" name="image_file" accept="image/*" style="display:none">
              <button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.getElementById('imageInput').click()">
                  <i class="bi bi-image"></i> Photo
              </button>
              @error('image_file')
                  <div class="text-danger small">{{ $message }}</div>
              @enderror

              <!-- Video -->
              <input type="file" id="videoInput" name="video_file" accept="video/*" style="display:none">
              <button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.getElementById('videoInput').click()">
                  <i class="bi bi-camera-video"></i> Video
              </button>
              @error('video_file')
                  <div class="text-danger small">{{ $message }}</div>
              @enderror
          </div>
          <small id="charCount" class="text-muted">0 / 500 characters</small>
      </div>

      <div id="filePreview" class="mt-2"></div>
      <button type="submit" id="shareBtn" class="btn btn-dark w-100 mt-2">Share Post</button>
  </form>

@push('scripts')
<script>
  const textarea = document.getElementById('postContent');
  const shareBtn = document.getElementById('shareBtn');
  const charCountDisplay = document.getElementById('charCount');
  const maxLength = 500;

  const imageInput = document.getElementById('imageInput');
  const videoInput = document.getElementById('videoInput');
  const filePreview = document.getElementById('filePreview');

  let selectedFile = null;

  textarea.addEventListener('input', () => {
    updateCharCount();
    updateShareButton();
  });

  function updateCharCount() {
    const length = textarea.value.length;
    charCountDisplay.textContent = `${length} / ${maxLength} characters`;
  }

  imageInput.addEventListener('change', () => handleFile(imageInput.files[0], 'image', 5 * 1024 * 1024));
  videoInput.addEventListener('change', () => handleFile(videoInput.files[0], 'video', 25 * 1024 * 1024));

  function handleFile(file, type, maxSize) {
    if (!file) return;

    if (file.size > maxSize) {
      alert(`${type === 'image' ? 'Image' : 'Video'} size exceeds ${maxSize / (1024*1024)}MB`);
      if (type === 'image') imageInput.value = '';
      else videoInput.value = '';
      return;
    }

    selectedFile = file;
    previewFile(file, type);
    updateShareButton();
  }

  function previewFile(file, type) {
    filePreview.innerHTML = '';
    const container = document.createElement('div');
    container.style.position = 'relative';

    let media;
    if (type === 'image') {
      media = document.createElement('img');
      media.src = URL.createObjectURL(file);
      media.style.maxWidth = '150px';
      media.className = 'rounded';
    } else {
      media = document.createElement('video');
      media.src = URL.createObjectURL(file);
      media.controls = true;
      media.style.maxWidth = '200px';
      media.className = 'rounded';
    }
    container.appendChild(media);

    const removeBtn = document.createElement('button');
    removeBtn.type = 'button';
    removeBtn.textContent = '×';
    removeBtn.style.position = 'absolute';
    removeBtn.style.top = '-5px';
    removeBtn.style.right = '-5px';
    removeBtn.style.background = 'red';
    removeBtn.style.color = 'white';
    removeBtn.style.border = 'none';
    removeBtn.style.borderRadius = '50%';
    removeBtn.style.width = '25px';
    removeBtn.style.height = '25px';
    removeBtn.style.cursor = 'pointer';
    removeBtn.onclick = () => {
      selectedFile = null;
      imageInput.value = '';
      videoInput.value = '';
      filePreview.innerHTML = '';
      updateShareButton();
    };
    container.appendChild(removeBtn);

    filePreview.appendChild(container);
  }

  function updateShareButton() {
    const length = textarea.value.length;
    shareBtn.disabled = length > maxLength;
    shareBtn.className = length > maxLength ? 'btn btn-secondary w-100 mt-2' : 'btn btn-dark w-100 mt-2';
  }
</script>
@endpush