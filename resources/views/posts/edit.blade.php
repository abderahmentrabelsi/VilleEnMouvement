@extends('layouts/contentLayoutMaster')

@section('title', 'Edit Post')

@section('content')
    <section id="basic-horizontal-layouts">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Post</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="title">Title</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="title" class="form-control" name="title" value="{{ $post->title }}" placeholder="Title" />
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="content">Content</label>
                                </div>
                                <div class="col-sm-9">
                                    <textarea id="content" class="form-control" name="content" placeholder="Content">{{ $post->content }}</textarea>
                                </div>
                            </div>

           

                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary me-1">Update</button>
                                <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection