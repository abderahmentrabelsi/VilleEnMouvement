@extends('layouts/contentLayoutMaster')

@section('title', 'Edit Complaint')

@section('content')
    <section id="basic-horizontal-layouts">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Complaint</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('complaints.update', $complaint->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="title">Title</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="title" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $complaint->title) }}" placeholder="Title" />
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="description">Description</label>
                                </div>
                                <div class="col-sm-9">
                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Description">{{ old('description', $complaint->description) }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="screenshot">Screenshot</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="file" id="screenshot" class="form-control @error('screenshot') is-invalid @enderror" name="screenshot" accept="image/*" />
                                    @if($complaint->screenshot)
                                        <a href="{{ asset('storage/' . $complaint->screenshot) }}" target="_blank">View Current Screenshot</a>
                                    @else
                                        No Screenshot
                                    @endif
                                    @error('screenshot')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary me-1">Update</button>
                                <a href="{{ route('complaints.index') }}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
