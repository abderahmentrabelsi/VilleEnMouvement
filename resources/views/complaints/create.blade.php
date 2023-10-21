@extends('layouts/contentLayoutMaster')

@section('title', 'Create Complaint')

@section('content')
    <section id="basic-horizontal-layouts">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Create Complaint</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('complaints.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="title">Title</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="title" class="form-control" name="title" placeholder="Title" />
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="description">Description</label>
                                </div>
                                <div class="col-sm-9">
                                    <textarea id="description" class="form-control" name="description" placeholder="Description"></textarea>
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="screenshot">Screenshot</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="file" id="screenshot" class="form-control" name="screenshot" accept="image/*" />
                                </div>
                            </div>

                            <!-- Add more form fields for other attributes here -->

                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary me-1">Submit</button>
                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
