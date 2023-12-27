@extends('base.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        {{-- form add new products --}}
        <div class="col-md-8 mb-5">
            <div class="card">
                <div class="card-header">{{ __('Edit Products') }}</div>
                <div class="card-body">
                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                          <label for="name">Product Name</label>
                          <input type="text" class="form-control" id="name" name="name" placeholder="Product Name" value="{{ $product->name }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                          <label for="name">Product Description</label>
                          <input type="text" class="form-control" id="description" name="description" placeholder="Product Description" value="{{ $product->description }}">
                          @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                           @enderror
                        </div>

                        <div class="form-group">
                          <label for="name">Product Price</label>
                          <input type="text" class="form-control" id="price" name="price" placeholder="Product Price" value="{{ $product->price }}">
                          @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                         <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" width="250px">
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="image">Product Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
        
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
