<!-- resources/views/voyages/create.blade.php -->

@extends('layouts.contentLayoutMaster')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Create a Voyage</h1>
            </div>
            <div class="card-body">
                <!-- Your form goes here -->
                <form action="{{ route('voyages.store') }}" method="POST">
                    @csrf
                    @method('POST') <!-- Use the POST method for create -->

  <!-- Add your form fields here -->
  <div class="mb-3">
      <label for="date_voyage" class="form-label">Date:</label>
      <input type="date" name="date_voyage" class="form-control" required>
  </div>

  <div class="mb-3">
      <label for="heure" class="form-label">Heure:</label>
      <input type="time" name="heure" class="form-control" required>
  </div>

  <div class="mb-3">
      <label for="nbr_places" class="form-label">Number of Places:</label>
      <input type="number" name="nbr_places" class="form-control" required>
  </div>

  <div class="mb-3">
      <label for="lieu_depart" class="form-label">Departure Location:</label>
      <input type="text" name="lieu_depart" class="form-control" required>
  </div>

  <div class="mb-3">
      <label for="lieu_arrive" class="form-label">Arrival Location:</label>
      <input type="text" name="lieu_arrive" class="form-control" required>
  </div>

   <div class="mb-3">
      <label for="prix" class="form-label">Price:</label>
      <input type="number" name="prix" class="form-control" required>
    </div>


    <div class="mb-3">
        <label for="telephone" class="form-label">Tel:</label>
        <input type="number" name="telephone" class="form-control" required>
    </div>



  <button type="submit" class="btn btn-primary">Create Voyage</button>
</form>
</div>
</div>
</div>
@endsection
