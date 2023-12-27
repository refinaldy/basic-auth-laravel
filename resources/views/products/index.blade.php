@extends('layouts.base')

@section('page_title')
    {{ __('Products') }}
@endsection

@push('custom_script')
    <script>
        let btnAddNewImage = document.getElementById('btnAddNewImage');
        btnAddNewImage.addEventListener('click', function(){
            let btnAddImageContainer = document.getElementById('btnAddImageContainer');
            let imageInputContainer = document.createElement('div');
            imageInputContainer.classList.add('form-group');
            imageInputContainer.classList.add('mb-3');

            let imageCounter = 2;

            let imageInputEl = document.createElement('input');
            imageInputEl.setAttribute('type', 'file');
            imageInputEl.setAttribute('name', 'images' + '-' + imageCounter);
            imageInputEl.setAttribute('data-id', imageCounter);

            imageInputContainer.appendChild(imageInputEl);

            btnAddImageContainer.insertAdjacentElement('afterend', imageInputContainer);
        });
    </script>
@endpush

@section('content')
<div class="card">
    
    <div class="card-header">{{ __('Add Products') }}</div>
    <div class="card-body">
        @if (session('errors'))
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Product Name" value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label for="name">Product Description</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="Product Description" value="{{ old('description') }}">
            </div>

            <div class="form-group">
                <label for="name">Product Price</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Product Price" value="{{ old('price') }}">
            </div>
            
            <div class="form-group mb-3" id="btnAddImageContainer">
                <label for="image">Product Image </label>
                <button type="button" id="btnAddNewImage" class="btn btn-info btn-sm"> + </button>
            </div>

            <div class="form-group mb-3">
                <input type="file" class="form-control" id="image" name="images[]" multiple>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
    </div>
</div>

<div class="card">
    <div class="card-header">{{ __('List Products') }}</div>
    <div class="card-body">
        <table class="table table-responsive">
            <tr>
                <td>No</td>
                <td>Name</td>
                <td>Price</td>
                <td>Description</td>
                <td>Image</td>
                <td>Status</td>
                <td>Action</td>
            </tr>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->description }}</td>
                    <td>
                       @foreach ($product->images as $image)
                        <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $image->path }}" width="200px">
                        </br>
                       @endforeach
                    </td>
                    <td>{{ $product->published_at ? 'PUBLISHED' : 'DRAFT'  }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mt-2">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No products found.</td>
                </tr>
            @endforelse
        </table>
    </div>
</div>
@endsection
