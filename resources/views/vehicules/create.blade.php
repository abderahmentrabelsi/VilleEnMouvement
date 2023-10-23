@extends('layouts/contentLayoutMaster')

@section('title', 'Create Vehicule')

@section('content')
    <section id="basic-horizontal-layouts">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Create Vehicule</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('vehicules.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="model">Model</label>
                                </div>
                                <div class="col-sm-9">
                                <input type="text" id="model" class="form-control @error('model') is-invalid @enderror" name="model" placeholder="Model" />
        @error('model')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
                                </div>
                            </div>

                            <div class="mb-1 row">
    <div class="col-sm-3">
        <label class="col-form-label" for="type">Type</label>
    </div>
    <div class="col-sm-9">
        <select id="type" class="form-control @error('type') is-invalid @enderror" name="type">
            <option value="">Select a type</option>
            <option value="truck">Truck</option>
            <option value="sedan">Sedan</option>
            <option value="van">Van</option>
        </select>
        @error('type')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="mb-1 row">
    <div class="col-sm-3">
        <label class="col-form-label" for="capacity">Capacity</label>
    </div>
    <div class="col-sm-9">
        <select id="capacity" class="form-control @error('capacity') is-invalid @enderror" name="capacity">
            <option value="">Select a capacity</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="8">8</option>
        </select>
        @error('capacity')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="mb-1 row">
    <div class="col-sm-3">
        <label class="col-form-label" for="price">Price</label>
    </div>
    <div class="col-sm-9">
        <input id="price" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Price"></input>
        @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="mb-1 row">
    <div class="col-sm-3">
        <label class="col-form-label" for="plateNumber">Plate Number</label>
    </div>
    <div class="col-sm-9">
        <input id="plateNumber" class="form-control @error('plateNumber') is-invalid @enderror" name="plateNumber" placeholder="Plate Number"></input>
        @error('plateNumber')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
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