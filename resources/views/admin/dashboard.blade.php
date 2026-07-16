@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard overview')

@section('content')
  <div class="row g-3 g-xl-4 mb-4">
    @foreach([
      ['Total orders', $stats['total'], 'bi-bag-check', 'purple'],
      ['Pending', $stats['pending'], 'bi-hourglass-split', 'amber'],
      ['Processing', $stats['processing'], 'bi-arrow-repeat', 'cyan'],
      ['Completed', $stats['completed'], 'bi-check2-circle', 'green'],
    ] as [$label, $value, $icon, $tone])
      <div class="col-6 col-xl-3">
        <article class="stat-card h-100">
          <span class="stat-icon {{ $tone }}"><i class="bi {{ $icon }}"></i></span>
          <div><p>{{ $label }}</p><strong>{{ number_format($value) }}</strong></div>
        </article>
      </div>
    @endforeach
  </div>

  <div class="row g-4 mb-4">
    <div class="col-lg-8">
      <section class="admin-card h-100">
        <div class="card-heading"><div><p class="section-kicker">Latest activity</p><h2>Recent orders</h2></div><a href="{{ route('admin.orders.index') }}">View all <i class="bi bi-arrow-right"></i></a></div>
        <div class="table-responsive">
          <table class="table admin-table align-middle mb-0">
            <thead><tr><th>Order</th><th>Game</th><th>Amount</th><th>Status</th><th></th></tr></thead>
            <tbody>
              @forelse($recentOrders as $order)
                <tr><td><strong>{{ $order->reference }}</strong><small>{{ $order->created_at->diffForHumans() }}</small></td><td>{{ $order->game_name }}<small>{{ $order->package_name }}</small></td><td>৳{{ number_format($order->amount) }}</td><td><span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span></td><td class="text-end"><a class="icon-link-btn" href="{{ route('admin.orders.show', $order) }}" aria-label="View order"><i class="bi bi-chevron-right"></i></a></td></tr>
              @empty
                <tr><td colspan="5" class="empty-state">No orders yet. New storefront orders will appear here.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </section>
    </div>
    <div class="col-lg-4">
      <section class="revenue-card h-100">
        <span class="revenue-icon"><i class="bi bi-graph-up-arrow"></i></span>
        <p>Completed revenue</p><h2>৳{{ number_format($stats['revenue']) }}</h2>
        <div class="revenue-meta"><span><i class="bi bi-controller"></i>{{ $gameCount }} games live</span><span><i class="bi bi-shield-check"></i>System online</span></div>
        <a class="btn revenue-button" href="{{ route('admin.orders.index', ['status' => 'completed']) }}">View completed orders</a>
      </section>
    </div>
  </div>
@endsection
