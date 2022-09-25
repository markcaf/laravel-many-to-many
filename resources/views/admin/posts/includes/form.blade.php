<div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input name="title" value="{{ old('title', $post->title) }}" type="text" class="form-control" id="title"
        aria-describedby="titleHelp" required>
    <div id="titleHelp" class="form-text">Insert here your post's title.</div>

    @error('title')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror
</div>



<div class="mb-3">
    <label for="post_content" class="form-label">Post content</label>
    <textarea name="post_content" class="form-control" id="post_content" rows="3" required>{{ old('post_content', $post->post_content) }}</textarea>

    @error('post_content')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label for="post_image" class="form-label">Post image</label>
    <input name="post_image" value="{{ old('post_image', $post->post_image) }}" type="text" class="form-control" id="post_image"
        aria-describedby="post_imageHelp">
    <div id="post_imageHelp" class="form-text">Insert here your post image by writing the URL.</div>

    @error('post_image')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label for="input-tags" class="form-label">Tags</label>
    @foreach ($tags as $tag)
        <div class="form-check form-switch">
            @if ($errors -> any())
                <input type="checkbox" 
                name="tags[]" 
                id="input-tags" 
                class="form-check-input" 
                value="{{ $tag->id }}" 
                {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>

            @else
                <input type="checkbox" 
                name="tags[]" 
                id="input-tags" 
                class="form-check-input" 
                value="{{ $tag->id }}" 
                {{ $post->tags->contains($tag) ? 'checked' : '' }}>
            @endif

            <label for="input-tags" class="form-check-label">
                {{ $tag->name }}
            </label>

        </div>
    @endforeach

    @error('tags')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="text-center mt-5">
    <button type="submit" class="btn btn-lg btn-primary text-uppercase fw-bold">Submit post</button>
</div>
