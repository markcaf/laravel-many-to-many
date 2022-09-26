@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('created'))
            <div class="col-12 alert alert-success">
                "{{ session('created') }}" has been successfully created.
            </div>
        @endif

        @if (session('edited'))
            <div class="col-12 alert alert-success">
                "{{ session('edited') }}" has been successfully edited.
            </div>
        @endif

        <div class="row">
            <div class="col-4">
                <div class="card">
                    <img class="card-img-top" src="{{ asset('storage/' . $post->post_image) }}" alt="Card image cap">
                    <div class="card-body">
                      <p class="card-text text-center">Featured image: <br><em>{{ $post->title }}</em></p>
                    </div>
                </div>

                <div class="mt-3">
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Author:</strong> {{ $post->user->name }}
                                </li>
                            <li class="list-group-item">
                                <strong>User roles:</strong> 
                                @forelse ($post->user->roles as $role)
                                    {{ $role->name }}
                                @empty
                                    no roles
                                @endforelse
                            </li>
                            <li class="list-group-item">
                                <strong>Post ID:</strong> {{ $post->id }}
                            </li>
                            <li class="list-group-item">
                                <strong>Tags:</strong> 
                                <span class="badge badge-pill">
                                    @if (isset($post->tags))
                                        @foreach ($post->tags as $tag )
                                        {{ $tag->name }} -
                                        @endforeach
                                    @else
                                        No tag selected for this post
                                    @endif
                                </span>
                            </li>
                            <li class="list-group-item">
                                <strong>Post Date:</strong> {{ $post->post_date }}
                            </li>
                            </ul>
                    </div>
                </div>

                <div class="col-12 mt-4 d-flex justify-content-center align-items-center">
                    <div>
                        <a href="{{ route('admin.posts.edit', $post->slug) }}" class="btn btn btn-success mx-2">
                            Edit
                        </a>
                    </div>
    
                    <div>
                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="form-post-delete"
                            data-post-name="{{ $post->title }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn btn-danger mx-2">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8 d-flex flex-column justify-content-between">
                <div>
                    <h2 class="my-3">{{ $post->title }}</h2>
                    <p>{{ $post->post_content }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
