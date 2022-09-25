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

<div class="text-center mt-5">
    <button type="submit" class="btn btn-lg btn-primary text-uppercase fw-bold">Submit post</button>
</div>
