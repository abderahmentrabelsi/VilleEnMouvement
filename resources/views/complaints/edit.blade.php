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
                                    <input type="text" id="title" class="form-control" name="title" value="{{ $complaint->title }}" placeholder="Title" />
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="description">Description</label>
                                </div>
                                <div class="col-sm-9">
                                    <textarea id="description" class="form-control" name="description" placeholder="Description">{{ $complaint->description }}</textarea>
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="screenshot">Screenshot</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="file" id="screenshot" class="form-control" name="screenshot" accept="image/*" />
                                    @if($complaint->screenshot)
                                        <a href="{{ asset('storage/' . $complaint->screenshot) }}" target="_blank">View Current Screenshot</a>
                                    @else
                                        No Screenshot
                                    @endif
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
