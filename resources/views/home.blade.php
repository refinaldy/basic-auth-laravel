@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <div id="favicon-container"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
   function getFavicon(url) {
    const proxyUrl = '/get-favicon?url=' + encodeURIComponent(url);

    fetch(proxyUrl)
        .then(response => response.json())
        .then(data => {
            console.log('Favicon data:', data);
            const faviconUrl = data.faviconUrl;

            const faviconContainer = document.getElementById('favicon-container');
            const faviconImage = document.createElement('img');
            faviconImage.src = faviconUrl;
            faviconImage.width = 16;
            faviconImage.height = 16;
            faviconContainer.appendChild(faviconImage);
            
        })
        .catch(error => {
            console.error('Error fetching favicon:', error);
        });
    }

    const urlToFetch = 'https://facebook.com';
    getFavicon(urlToFetch);
  </script>
@endpush