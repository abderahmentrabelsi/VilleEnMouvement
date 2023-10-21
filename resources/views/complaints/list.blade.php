@extends('layouts/contentLayoutMaster')

@section('title', 'Complaints List')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/animate/animate.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css'))}}">
@endsection

@section('content')
    <section id="basic-horizontal-layouts">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Your Complaints</h4>
                    </div>
                    <div class="card-body">
    <a href="{{ route('complaints.create') }}" class="btn btn-primary mb-2">Add Complaint</a>

    <form class="d-flex align-items-center justify-content-between mb-2" method="GET" action="{{ route('complaints.index') }}">
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
            <th>Title</th>
            <th>Description</th>
            <th>Created At</th>
            <th>Screenshot</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($complaints as $complaint)
            <tr>
                <td>{{ $complaint->title }}</td>
                <td>{{ $complaint->description }}</td>
                <td>{{ $complaint->created_at }}</td>
                <td>
                    @if($complaint->screenshot)
                        <a href="{{ asset('storage/' . $complaint->screenshot) }}" target="_blank">View Screenshot</a>
                    @else
                        No Screenshot
                    @endif
                </td>
                <td>
                    <a href="{{ route('complaints.edit', $complaint->id) }}" class="btn btn-primary">Edit</a>
                    <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $complaint->id }})">Delete</button>
                    <form id="delete-form-{{ $complaint->id }}" action="{{ route('complaints.destroy', $complaint->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br><br>
    <div class="d-flex justify-content-center">
        {{ $complaints->links() }}
</div>
</div>
                </div>
            </div>
        </div>
    </section>
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
</section>
@endsection

@section('page-script')
    <script src="{{ asset(mix('js/scripts/extensions/ext-component-sweet-alerts.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
</section>
@endsection