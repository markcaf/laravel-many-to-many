@extends('layouts.app')

@section('content')
    <div class="container my-5 py-2">
        <div class="row justify-content-center">
            <div class="col-6">

                {{-- Specifico rotta e metodo del form --}}
                <form action="{{ route('admin.posts.update', $post->slug) }}" method="POST" enctype="multipart/form-data">
                    {{-- Inserisco CSRF di sicurezza di Laravel --}}
                    @csrf
                    @method('PUT')
                        @include('admin.posts.includes.form')
                </form>

            </div>
        </div>
    </div>
@endsection