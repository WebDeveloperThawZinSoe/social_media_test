@extends('layouts.master')

@section('title','Login / Register')

@push('styles')
<style>


    /* Feed wrapper */
    .feed-container {
      max-width: 600px;
      margin: 40px auto;
    }

    /* Card styles */
    .card {
      border-radius: 16px;
      border: 1px solid #e5e7eb;
      box-shadow: 0 2px 8px rgba(0,0,0,0.04);
      margin-bottom: 20px;
    }

    /* Composer */
    .composer textarea {
      resize: none;
      border-radius: 12px;
      font-size: 15px;
    }
    .composer .btn {
      border-radius: 10px;
    }

    /* Post header */
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

    /* Post image */
    .post-img {
      border-radius: 12px;
      margin-top: 10px;
    }

    /* Actions */
    .post-actions {
      display: flex;
      gap: 20px;
      font-size: 14px;
      color: #444;
    }
    .post-actions i {
      margin-right: 5px;
    }

    /* Comment box */
    .comment-box {
      border-radius: 20px;
      font-size: 14px;
      padding: 8px 14px;
    }

    /* Comment section */
    .comments {
      margin-top: 15px;
    }
    .comment {
      display: flex;
      align-items: flex-start;
      margin-bottom: 10px;
      gap: 10px;
    }
    .comment img {
      width: 34px;
      height: 34px;
      border-radius: 50%;
    }
    .comment-body {
      background: #f3f4f6;
      padding: 8px 12px;
      border-radius: 12px;
      font-size: 14px;
    }
    .comment strong {
      font-size: 13px;
      display: block;
    }
</style>
@endpush

@section('content')
@include("layouts.nav")
<!-- Feed -->
<div class="feed-container">

  <!-- Create Post -->
  <div class="card composer p-3">
    <h6 class="fw-bold mb-2">Create a post</h6>
    <textarea class="form-control mb-2" rows="3" placeholder="What's happening in your world?" maxlength="500"></textarea>
    <div class="d-flex justify-content-between">
      <div>
        <button class="btn btn-outline-secondary btn-sm"><i class="bi bi-image"></i> Photo</button>
        <button class="btn btn-outline-secondary btn-sm"><i class="bi bi-camera-video"></i> Video</button>
      </div>
      <button class="btn btn-dark">Share Post</button>
    </div>
  </div>

  <!-- Post 1 -->
  <div class="card p-3">
    <div class="post-header">
      <img src="https://i.pravatar.cc/40?img=12" class="post-avatar">
      <div>
        <strong>mike_digital</strong><br>
        <span class="post-meta">2h ago</span>
      </div>
    </div>
    <p class="mt-2">
      Just wrapped up a 6-month digital transformation project for a Fortune 500 company. 
      The journey from legacy systems to modern, user-centric design has been incredible...
    </p>
    <img src="https://images.unsplash.com/photo-1581093588401-22f1f1f6f5c3?auto=format&fit=crop&w=900&q=80" class="img-fluid post-img">

    <div class="d-flex justify-content-between mt-3">
      <div class="post-actions">
        <span><i class="bi bi-heart"></i> 2</span>
        <span><i class="bi bi-chat"></i> 1</span>
      </div>
    </div>

    <!-- Comments -->
    <div class="comments">
      <div class="comment">
        <img src="https://i.pravatar.cc/34?img=5">
        <div class="comment-body">
          <strong>jane_dev</strong>
          Wow! That must’ve been a huge challenge. Congrats 🎉
        </div>
      </div>
    </div>

    <input type="text" class="form-control comment-box mt-2" placeholder="Write a comment...">
  </div>

  <!-- Post 2 -->
  <div class="card p-3">
    <div class="post-header">
      <img src="https://i.pravatar.cc/40?img=22" class="post-avatar">
      <div>
        <strong>lisa_ux</strong><br>
        <span class="post-meta">6h ago</span>
      </div>
    </div>
    <p class="mt-2">
      UX principle reminder: Your users don’t care how clever your design is—they care about whether it solves their problem. 
      Today I removed 3 features from a product because they were adding complexity without adding value...
    </p>
    <div class="d-flex justify-content-between mt-2">
      <div class="post-actions">
        <span><i class="bi bi-heart-fill text-danger"></i> 1</span>
        <span><i class="bi bi-chat"></i> 1</span>
      </div>
    </div>

    <!-- Comments -->
    <div class="comments">
      <div class="comment">
        <img src="https://i.pravatar.cc/34?img=11">
        <div class="comment-body">
          <strong>dev_mark</strong>
          That’s so true. Removing clutter often makes UX 10x better.
        </div>
      </div>
    </div>

    <input type="text" class="form-control comment-box mt-2" placeholder="Write a comment...">
  </div>

</div>
@endsection
