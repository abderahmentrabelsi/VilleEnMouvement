@extends('layouts/contentLayoutMaster')

@section('title', 'Ratings List')

@section('content')
    <section id="basic-horizontal-layouts">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Your Ratings</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('ratings.create') }}" class="btn btn-primary mb-2">Add Rating</a>

                        <form class="d-flex align-items-center justify-content-between mb-2" method="GET" action="{{ route('ratings.index') }}">
                            <div class="form-group">
                                <input type="text" name="search" class="form-control" placeholder="Search by Title" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </form>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Rating Value</th>
                                    <th>Comments</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ratings as $rating)
                                    <tr>
                                        <td>{{ $rating->rating_value }}</td>
                                        <td>{{ $rating->comments }}</td>
                                        <td>{{ $rating->created_at }}</td>
                                        <td>
                                            <a href="{{ route('ratings.edit', $rating->id) }}" class="btn btn-primary">Edit</a>
                                            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $rating->id }})">Delete</button>
                                            <form id="delete-form-{{ $rating->id }}" action="{{ route('ratings.destroy', $rating->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(session('alreadyRated'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'You have already rated!',
            text: 'You can only rate once.',
        });
    </script>
@endif
@endsection



@section('page-script')
    <script>
        function confirmDelete(ratingId) {
            if (confirm('Are you sure you want to delete this rating?')) {
                // If confirmed, submit the delete form
                document.getElementById('delete-form-' + ratingId).submit();
            }
        }
    </script>
@endsection
