@extends('layouts/contentLayoutMaster')

@section('title', 'Posts List')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/animate/animate.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css'))}}">
@endsection

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="border p-4">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="title">Title</label>
                        <input type="text" id="title" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Title" value="{{ old('title') }}" />
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="content">Content</label>
                        <textarea id="content" class="form-control @error('content') is-invalid @enderror" name="content" placeholder="Content">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="image">Image</label>
                        <input type="file" id="image" class="form-control @error('image') is-invalid @enderror" name="image" />
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Add Post</button>
                </form>
            </div>
        </div>
    
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                @foreach($posts as $post)
    <div class="card mb-3">
        @if ($post->image)
            <img src="{{ asset($post->image) }}" class="card-img-top" alt="{{ $post->title }}" />
        @endif
        <div class="card-body">
            <p class="card-text"><small class="text-muted">Posted by {{ $post->user->name }} {{ $post->created_at->diffForHumans() }}</small></p>
            @if ( request()->query('editing_post_id') == $post->id)
                <form action="{{ route('posts.update',   $post->id ) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $post->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="3" required>{{ old('content', $post->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary" >Update</button>
                    <button type="button" class="btn btn-secondary" onclick="window.location='{{ route('posts.index') }}'">Cancel</button>
                </form>
            @else
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->content }}</p>
                <hr>
                <h6>{{ $post->comments->count() }} Comments</h6>
                <div>
                    @if ($post->likes)
                        <h6><span id="likes-count-{{ $post->id }}">{{ $post->likes->count() }}</span> Likes</h6>
                        <form action="{{ route('likes.store') }}" method="POST" class="d-inline like-form">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <button type="submit" class="btn btn-link">Like</button>
                        </form>
                    @endif
                </div>
                <br>
                <ul class="list-unstyled">
                    @foreach($post->comments()->orderBy('created_at', 'desc')->paginate(10) as $comment)
                        <li>
                            <p>{{ $comment->content }}</p>
                            <p class="card-text"><small class="text-muted">Commented by {{ $comment->user->name }} {{ $comment->created_at->diffForHumans() }}</small></p>
                            <hr>
                        </li>
                    @endforeach
                </ul>
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="content">Add a comment</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="3" required>{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                
                @if (Auth::check() && Auth::user()->id === $post->user_id)
                <button type="button" class="btn btn-primary" onclick="window.location='{{ route('posts.index', [ 'editing_post_id' => $post->id]) }}'">Edit</button>

                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            @endif
            @endif
        </div>
    </div>
@endforeach
            </div>
        </div>
    </div>
</section>
@endsection

<script>
    function confirmDelete(complaintId) {
        Swal.fire({
            title: 'Confirm Delete',
            text: 'Are you sure you want to delete this complaint?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it'
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, submit the delete form
                document.getElementById('delete-form-' + complaintId).submit();
            }
        });
    }
</script>




@section('vendor-script')
    <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
@endsection
@section('page-script')
    <script src="{{ asset(mix('js/scripts/extensions/ext-component-sweet-alerts.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
@endsection

<script>
    $(document).ready(function() {
        $('.like-form').submit(function(event) {
            event.preventDefault();

            var form = $(this);
            var url = form.attr('action');
            var data = form.serialize();

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function(response) {
                    var likesCount = response.likesCount;
                    var postId = form.find('input[name="post_id"]').val();
                    $('#likes-count-' + postId).text(likesCount);
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>