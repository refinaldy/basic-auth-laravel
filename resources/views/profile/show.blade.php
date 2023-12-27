@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 p-1">
            <div class="row mb-3">
                <div class="col-sm-3 col-3">
                    <img width="75px" src="{{ $user->profile->profile_picture ?  asset('storage/' . $user->profile->profile_picture) : asset('assets/img/avatar/avatar-1.png') }}" alt="avatar">
                </div>
                <div class="col-sm-8 col-8">
                  <h5>{{ $user->username }}</h5>
                  <div class="row">
                  </div>
                  <div class="row">
                    <p>{{ $user->profile->description }}</p>
                  </div>
                </div>
            </div>

            <div class="row mb-3 justify-content-between">
                @forelse ($user->user_links as $link)
                  <div class="col">
                    <a href="{{ $link->url }}">
                      <img width="25px" src="{{ $link->favicon_url }}" alt="{{ $link->link }}">
                    </a>
                  </div>
                @empty
                  <p>No links available</p>
                @endforelse
            </div>

            <div class="row mb-3 p-1">
              @forelse ($user->products as $product)
                <a href="{{ $product->url ? $product->url : route('profile.showProduct', [$user->username, $product->id]) }}">
                  <div class="card mb-2">
                    <div class="card-body">
                        <div class="row">
                          <div class="col-4">
                            <img width="100px" src="{{ $product->image_url }}" alt="{{ 'Gambar ' . $product->name }}">
                          </div>
                          <div class="col">
                            <div class="row">
                              <h5>{{ $product->name }}</h5>
                            </div>
                            <div class="row">
                              <p>{{ $product->description }}</p>
                            </div>
                            <div class="row">
                              <p>{{ 'Rp. ' . $product->price }}</p>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
                </a>
              @empty
              <div class="card">
                <div class="card-body">
                  <p>No Products available</p>
                </div>
              </div>
                
              @endforelse
          </div>


        </div>
    </div>
</div>
@endsection