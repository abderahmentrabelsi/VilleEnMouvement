<!-- resources/views/voyages/index.blade.php -->
@extends('layouts.contentLayoutMaster')

@section('content')

    <div class="d-flex  align-items-center justify-content-between mb-2">
        <h1>Voyages List <a href="{{ route('/voyages.create') }}" ><i data-feather='folder-plus'></i></a> </h1>

        <!-- Search Form -->
        <form action="{{ route('voyages.index') }}" method="GET" class="mb-3" style="max-width: 300px;">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search...">
                <button type="submit" class="btn btn-primary">Search</button>

            </div>
        </form>
    </div>





    <div class="row"   style="margin-top: 20px">
        @foreach($voyages as $voyage)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Voyage Information</h5>
                        <p class="card-text">
                            <strong>Date:</strong> {{ $voyage->date_voyage }}<br>
                            <strong>Heure:</strong> {{ $voyage->heure }}<br>
                            <strong>Number of Places:</strong> {{ $voyage->nbr_places }}<br>
                            <strong>Departure Location:</strong> {{ $voyage->lieu_depart }}<br>
                            <strong>Arrival Location:</strong> {{ $voyage->lieu_arrive }}<br>
                        </p>
                        <hr>
                        <div class="text-center">

                            <a href="{{ route('voyages.edit', ['id' => $voyage->id]) }}" class="btn btn-secondary">Edit</a>
                            <a href="{{ route('voyages.show', ['id' => $voyage->id]) }}" class="btn btn-primary">Show</a>
                            <form action="{{ route('voyages.destroy', ['id' => $voyage->id]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- Default Pagination Starts -->
    <section id="default-pagination">
        <div class="row match-height">
            <!-- Basic Pagination starts -->
            <div class="d-flex justify-content-end">
                <nav aria-label="Page navigation">
                    <ul class="pagination mt-3">
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                        <li class="page-item"><a class="page-link" href="#">7</a></li>
                    </ul>
                </nav>
            </div>

@endsection

