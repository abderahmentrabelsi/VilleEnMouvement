@extends('layouts/contentLayoutMaster')

@section('title', 'Create Rating')

@section('content')
    <section id="basic-horizontal-layouts">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Create Rating</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('ratings.store') }}">
                            @csrf
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="rating_value">Rating</label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="rating">
                                        <i class="fas fa-star" data-rating="1"></i>
                                        <i class="fas fa-star" data-rating="2"></i>
                                        <i class="fas fa-star" data-rating="3"></i>
                                        <i class="fas fa-star" data-rating="4"></i>
                                        <i class="fas fa-star" data-rating="5"></i>
                                    </div>
                                    <input type="hidden" name="rating_value" id="rating_value" value="0">
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="comments">Comments</label>
                                </div>
                                <div class="col-sm-9">
                                    <textarea id="comments" class="form-control @error('comments') is-invalid @enderror" name="comments" placeholder="Comments"></textarea>
                                    @error('comments')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

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

@section('page-script')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    $(document).ready(function() {
        $(".rating i").click(function() {
            var ratingValue = $(this).data("rating");
            $("#rating_value").val(ratingValue);
            $(this).addClass("fas").removeClass("far"); // Add 'fas' class to make it solid
            $(this).prevAll().addClass("fas").removeClass("far");
            $(this).nextAll().removeClass("fas").addClass("far");
        });
    });
</script>
@endsection
