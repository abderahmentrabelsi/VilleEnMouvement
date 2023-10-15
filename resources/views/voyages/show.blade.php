@extends('layouts.contentLayoutMaster')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Voyage Details</h1>
                <a href="{{ route('voyages.index') }}" class="btn btn-primary">Back to Voyages</a>
            </div>
            <div class="card-body">
                <p>
                    <strong>Date:</strong> {{ $voyage->date_voyage }}<br>
                    <strong>Heure:</strong> {{ $voyage->heure }}<br>
                    <strong>Number of Places:</strong> {{ $voyage->nbr_places }}<br>
                    <strong>Departure Location:</strong> {{ $voyage->lieu_depart }}<br>
                    <strong>Arrival Location:</strong> {{ $voyage->lieu_arrive }}<br>
                </p>

                <!-- You can add more details or customize the display as needed -->

                <div class="text-center">
                    <a href="{{ route('voyages.edit', ['id' => $voyage->id]) }}" class="btn btn-secondary">Edit</a>
                    <button wire:click="delete({{ $voyage->id }})" class="btn btn-danger">Delete</button>

                </div>
            </div>
        </div>
    </div>
@endsection
