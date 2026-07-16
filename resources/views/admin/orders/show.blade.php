@extends('admin.layouts.app')

@section('title', $order->reference)
@section('page-title', 'Order details')

@section('content')
  <a class="back-link" href="{{ route('admin.orders.index') }}"><i class="bi bi-arrow-left"></i>Back to orders</a>
  <div class="row g-4 mt-1">
    <div class="col-xl-8">
      <section class="admin-card mb-4">
        <div class="order-hero">
          <div><p class="section-kicker">{{ $order->created_at->format('d M Y · h:i A') }}</p><h2>{{ $order->reference }}</h2></div>
          <span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
        </div>
        <div class="detail-grid">
          <div><span>Game</span><strong>{{ $order->game_name }}</strong></div>
          <div><span>Package</span><strong>{{ $order->package_name }}</strong></div>
          <div><span>Player ID</span><strong>{{ $order->player_id }}</strong></div>
          <div><span>Order amount</span><strong>৳{{ number_format($order->amount) }}</strong></div>
        </div>
      </section>
      <section class="admin-card">
        <div class="card-heading"><div><p class="section-kicker">Payment verification</p><h2>Payment information</h2></div></div>
        <div class="detail-grid">
          <div><span>Method</span><strong>{{ ucfirst($order->payment_method) }}</strong></div>
          <div><span>Sender number</span><strong>{{ $order->payer_number ?: 'Not provided' }}</strong></div>
          <div class="detail-wide"><span>Transaction ID</span><strong class="transaction-code">{{ $order->transaction_id ?: 'Wallet payment / not required' }}</strong></div>
          <div class="detail-wide"><span>Customer</span><strong>{{ $order->user?->name ?? 'Guest customer' }} @if($order->user)<small>{{ $order->user->email }}</small>@endif</strong></div>
        </div>
      </section>
    </div>
    <div class="col-xl-4">
      <section class="admin-card sticky-update-card">
        <div class="card-heading"><div><p class="section-kicker">Fulfilment</p><h2>Update order</h2></div></div>
        <form action="{{ route('admin.orders.update', $order) }}" method="post">@csrf @method('patch')
          <div class="p-4">
            <label class="form-label fw-bold" for="status">Order status</label>
            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
              @foreach(\App\Models\Order::STATUSES as $status)<option value="{{ $status }}" @selected(old('status', $order->status) === $status)>{{ ucfirst($status) }}</option>@endforeach
            </select>
            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
            <label class="form-label fw-bold mt-3" for="admin-note">Internal note</label>
            <textarea class="form-control @error('admin_note') is-invalid @enderror" id="admin-note" name="admin_note" rows="5" placeholder="Add fulfilment or verification notes...">{{ old('admin_note', $order->admin_note) }}</textarea>
            @error('admin_note')<div class="invalid-feedback">{{ $message }}</div>@enderror
            <button class="btn update-button w-100 mt-3" type="submit"><i class="bi bi-check2-circle"></i>Save changes</button>
          </div>
        </form>
      </section>
    </div>
  </div>
@endsection
