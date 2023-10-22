@extends('layouts/contentLayoutMaster')

@section('title', 'Edit Vehicule')

@section('content')
    <section id="basic-horizontal-layouts">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Vehicule</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('vehicules.update', $vehicule->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                       
                     
                            <div class="mb-1 row">
    <div class="col-sm-3">
        <label class="col-form-label" for="price">Price</label>
    </div>
    <div class="col-sm-9">
        <textarea id="price" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Price">{{ $vehicule->price }}</textarea>
        @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

                          

                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary me-1">Update</button>
                                <a href="{{ route('vehicules.index') }}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection