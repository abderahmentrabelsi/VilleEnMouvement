@extends('layouts.contentLayoutMaster')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Edit Voyage</h1>
            </div>
            <div class="card-body">
                <!-- Your form goes here -->
                <form action="{{ route('voyages.update', ['id' => $voyage->id]) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Use the PUT method for update -->

                    <!-- Add your form fields here -->
                    <div class="mb-3">
                        <label for="date_voyage" class="form-label">Date:</label>
                        <input type="date" name="date_voyage" class="form-control" value="{{ $voyage->date_voyage }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="heure" class="form-label">Heure:</label>
                        <input type="time" name="heure" class="form-control" value="{{ $voyage->heure }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="nbr_places" class="form-label">Number of Places:</label>
                        <input type="number" name="nbr_places" class="form-control" value="{{ $voyage->nbr_places }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="lieu_depart" class="form-label">Departure Location:</label>
                        <input type="text" name="lieu_depart" class="form-control" value="{{ $voyage->lieu_depart }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="lieu_arrive" class="form-label">Arrival Location:</label>
                        <input type="text" name="lieu_arrive" class="form-control" value="{{ $voyage->lieu_arrive }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Voyage</button>
                </form>
            </div>
        </div>
    </div>
@endsection
