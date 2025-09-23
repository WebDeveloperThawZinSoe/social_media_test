@extends('layouts.master')

@section('title','Login / Register')

@push('styles')
<style>
       

    /* Profile card */
    .profile-card {
      border: 1px solid #e5e7eb;
      border-radius: 16px;
      padding: 20px;
      background: #fff;
      box-shadow: 0 2px 6px rgba(0,0,0,0.04);
    }
    .profile-card img {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      margin-bottom: 10px;
    }
    .profile-stats {
      display: flex;
      justify-content: center;
      gap: 30px;
      margin-top: 10px;
      font-size: 14px;
    }
    .profile-stats div {
      text-align: center;
    }

    /* Post card */
    .post-card {
      border: 1px solid #e5e7eb;
      border-radius: 16px;
      background: #fff;
      box-shadow: 0 2px 6px rgba(0,0,0,0.04);
      padding: 15px;
      margin-bottom: 20px;
    }
    .post-header {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .post-header img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
    }
    .post-meta {
      font-size: 13px;
      color: #666;
    }
    .post-actions {
      display: flex;
      gap: 20px;
      font-size: 14px;
      color: #444;
      margin-top: 10px;
    }
    .post-actions i {
      margin-right: 5px;
    }
    .delete-btn {
      color: #aaa;
      cursor: pointer;
    }
    .delete-btn:hover {
      color: #e11d48;
    }
</style>
@endpush

@section('content')
@include("layouts.nav")
<div class="container col-10 col-md-6 mt-4">
  <div class="profile-card">
    <h6 class="fw-bold mb-3">Profile</h6>
    <div class="text-center">
      <img src="{{ Auth::user()->getProfilePhotoUrlAttribute() }}" alt="profile">
      <h5 class="fw-bold">{{ Auth::user()->name }}</h5>
      <p class="text-muted mb-2">{{ Auth::user()->email }}</p>
      <div class="profile-stats">
        <div><strong>1</strong><br>Posts</div>
        <div><strong>2</strong><br>Likes</div>
        <div><strong>0</strong><br>Comments</div>
      </div>
    </div>
  </div>

  <!-- Posts -->
  <h6 class="fw-bold mt-4 mb-3">Your Posts</h6>
  <div class="post-card">
    <div class="d-flex justify-content-between align-items-start">
      <div class="post-header">
        <img src="{{ Auth::user()->getProfilePhotoUrlAttribute() }}">
        <div>
          <strong>{{ Auth::user()->name }}</strong><br>
          <span class="post-meta">12h ago</span>
        </div>
      </div>
      <i class="bi bi-trash delete-btn"></i>
    </div>
    <p class="mt-2">
      Just deployed our new microservices architecture and we're seeing 40% faster load times across all applications. 
      The migration took 3 months but the performance gains are worth every late night. 
      Next up: implementing AI-powered caching strategies.
    </p>
    <div class="post-actions">
      <span><i class="bi bi-heart"></i> 2</span>
      <span><i class="bi bi-chat"></i> 0</span>
    </div>
  </div>
</div>

@endsection
