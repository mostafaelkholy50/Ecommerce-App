<x-admin>
<tr>
    <td>{{ $checkout->user->name }}</td>
    <td>{{ $checkout->Phone }}</td>
    <td>
        @if (strtolower($checkout->payment_status) == 'pending')
            <span class="badge bg-danger">Cash on delivery</span>
        @elseif (strtolower($checkout->payment_status) == 'paid')
            <span class="badge bg-success">Payment via wallet</span>
        @else
            <span class="badge bg-secondary">{{ ucfirst($checkout->payment_status) }}</span>
        @endif
    </td>
    <td>${{ number_format($checkout->total_price, 2) }}</td>
    <td>
        <a href="{{ route('admin.orderDetails', $checkout->id) }}" class="btn btn-info btn-sm">View</a>
    </td>
</tr>
</x-admin>

