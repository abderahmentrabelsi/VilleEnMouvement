@extends('layouts/contentLayoutMaster')

@section('title', 'Vehicules List')

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
                        <h4 class="card-title">Vehicules List</h4>
                    </div>
                    <div class="card-body">

                    <a href="{{ route('vehicules.create') }}" class="btn btn-primary mb-2">Add Vehicule</a>

<form class="d-flex align-items-center justify-content-between mb-2" method="GET" action="{{ route('vehicules.index') }}">
    <div class="form-group">
        <input type="text" name="search" class="form-control" placeholder="Search by Model" required>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Search</button>
    </div>
</form>

                        <table class="table">
                            <thead>
                            <tr>
                                <th>Model</th>
                                <th>Type</th>
                                <th>Capacity</th>
                                <th>Price</th>
                                <th>PlateNumber</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($vehicules as $vehicule)
                                <tr>
                                    <td>{{ $vehicule->model }}</td>
                                    <td>{{ $vehicule->type }}</td>
                                    <td>{{ $vehicule->capacity }}</td>
                                    <td>{{ $vehicule->price }}</td>
                                    <td>{{ $vehicule->plateNumber }}</td>

                            
                                    <td>
                                        <a href="{{ route('vehicules.edit', $vehicule->id) }}" class="btn btn-primary">Edit</a>
                                        <button type="button" class="btn btn-danger" onclick="confirmDelete({{$vehicule->id}})">Delete</button>
                                        <form id="delete-form-{{ $vehicule->id }}" action="{{ route('vehicules.destroy', $vehicule->id) }}" method="POST">
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
        {{ $vehicules->links() }}
</div>
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
    <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
@endsection