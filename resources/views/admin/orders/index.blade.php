@extends('admin.layouts.app')

@section('title', 'Orders')
@section('page-title', 'Order management')

@section('content')
  <section class="admin-card">
    <div class="card-heading flex-wrap gap-3">
      <div><p class="section-kicker">Operations</p><h2>All customer orders</h2></div>
      <form class="order-filters d-flex flex-wrap gap-2" method="get">
        <div class="filter-search"><i class="bi bi-search"></i><input class="form-control" name="search" value="{{ request('search') }}" placeholder="Order, player or transaction"></div>
        <select class="form-select" name="status" aria-label="Filter by status">
          <option value="">All statuses</option>
          @foreach(\App\Models\Order::STATUSES as $status)<option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst($status) }}</option>@endforeach
        </select>
        <button class="btn filter-button" type="submit">Filter</button>
        @if(request()->hasAny(['search', 'status']))<a class="btn btn-light" href="{{ route('admin.orders.index') }}">Reset</a>@endif
      </form>
    </div>
    <div class="table-responsive">
      <table class="table admin-table align-middle mb-0">
        <thead><tr><th>Reference</th><th>Customer / player</th><th>Product</th><th>Payment</th><th>Amount</th><th>Status</th><th></th></tr></thead>
        <tbody>
          @forelse($orders as $order)
            <tr>
              <td><strong>{{ $order->reference }}</strong><small>{{ $order->created_at->format('d M Y, h:i A') }}</small></td>
              <td>{{ $order->user?->name ?? 'Guest customer' }}<small>Player: {{ $order->player_id }}</small></td>
              <td>{{ $order->game_name }}<small>{{ $order->package_name }}</small></td>
              <td>{{ ucfirst($order->payment_method) }}<small>{{ $order->transaction_id ?: 'No transaction ID' }}</small></td>
              <td class="fw-bold">৳{{ number_format($order->amount) }}</td>
              <td><span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
              <td class="text-end"><a class="icon-link-btn" href="{{ route('admin.orders.show', $order) }}" aria-label="Manage order"><i class="bi bi-pencil-square"></i></a></td>
            </tr>
          @empty
            <tr><td colspan="7" class="empty-state">No matching orders found.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
    @if($orders->hasPages())<div class="pagination-wrap">{{ $orders->links() }}</div>@endif
  </section>
@endsection
