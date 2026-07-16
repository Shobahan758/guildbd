@extends('admin.layouts.app')

@section('title', 'Games')
@section('page-title', 'Games & packages')

@section('content')
  <div class="card-heading page-heading mb-4"><div><p class="section-kicker">Store catalogue</p><h2>Live top-up products</h2><p class="text-secondary mb-0">Products are loaded from the Laravel game configuration and used by both the storefront and order backend.</p></div></div>
  <div class="row g-4">
    @foreach($games as $slug => $game)
      <div class="col-md-6 col-xxl-4">
        <article class="game-admin-card h-100">
          <div class="game-admin-cover"><img src="{{ asset($game['image']) }}" alt="{{ $game['name'] }} artwork"><span>Live</span></div>
          <div class="game-admin-body">
            <p>{{ $game['region'] }}</p><h2>{{ $game['title'] }}</h2>
            <div class="game-admin-meta"><span><strong>{{ count($game['packages']) }}</strong> packages</span><span><strong>৳{{ number_format(min(array_column($game['packages'], 'price'))) }}</strong> starting</span></div>
            <div class="package-cloud">@foreach(array_slice($game['packages'], 0, 4) as $package)<span>{{ $package['name'] }}</span>@endforeach @if(count($game['packages']) > 4)<span>+{{ count($game['packages']) - 4 }} more</span>@endif</div>
            <a class="btn game-preview-button" href="{{ route('games.show', $slug) }}" target="_blank">Preview product <i class="bi bi-box-arrow-up-right"></i></a>
          </div>
        </article>
      </div>
    @endforeach
  </div>
@endsection
