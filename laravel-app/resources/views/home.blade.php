@extends('layouts.master')

@section('title','Home Feed')

@push('styles')
<style>
  .feed-container {
    max-width: 600px;
    margin: 40px auto;
  }
  .card {
    border-radius: 16px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    margin-bottom: 20px;
  }
  .post-header {
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .post-avatar {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    object-fit: cover;
  }
  .post-meta {
    font-size: 13px;
    color: #666;
  }
  .post-img {
    border-radius: 12px;
    margin-top: 10px;
  }
  .post-actions {
    display: flex;
    gap: 20px;
    font-size: 14px;
    color: #444;
  }
  .post-actions i {
    margin-right: 5px;
  }
  .comment-box {
    border-radius: 20px;
    font-size: 14px;
    padding: 8px 14px;
  }
</style>
@endpush

@section('content')
@include("layouts.nav")


<div class="feed-container" id="post-container">
    @include("create-post")
    @include("components.post", ['posts' => $posts])
</div>

<div id="loading" class="text-center my-3" style="display:none;">
    <div class="spinner-border text-primary" role="status"></div>
</div>
@endsection

