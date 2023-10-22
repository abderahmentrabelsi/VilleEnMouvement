@extends('layouts/contentLayoutMaster')

@section('title', 'Edit Rating')

@section('content')
    <section id="basic-horizontal-layouts">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Rating</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('ratings.update', $rating->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="rating_value">Rating Value</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="number" id="rating_value" class="form-control @error('rating_value') is-invalid @enderror" name="rating_value" value="{{ old('rating_value', $rating->rating_value) }}" placeholder="Rating Value" />
                                    @error('rating_value')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="comments">Comments</label>
                                </div>
                                <div class="col-sm-9">
                                    <textarea id="comments" class="form-control @error('comments') is-invalid @enderror" name="comments" placeholder="Comments">{{ old('comments', $rating->comments) }}</textarea>
                                    @error('comments')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Add more form fields for other attributes here -->

                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary me-1">Update</button>
                                <a href="{{ route('ratings.index') }}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
