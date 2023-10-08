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
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Complaints List</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Screenshot</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($complaints as $complaint)
                                <tr>
                                    <td>{{ $complaint->title }}</td>
                                    <td>{{ $complaint->description }}</td>
                                    <td>
                                        @if($complaint->screenshot)
                                            <a href="{{ asset('storage/' . $complaint->screenshot) }}" target="_blank">View Screenshot</a>
                                        @else
                                            No Screenshot
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('complaints.edit', $complaint->id) }}" class="btn btn-primary">Edit</a>
                                        <button type="submit" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $complaint->id }}').submit();">Delete</button>
                                        <form id="delete-form-{{ $complaint->id }}" action="{{ route('complaints.destroy', $complaint->id) }}" method="POST" style="display: none;">
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
@endsection
