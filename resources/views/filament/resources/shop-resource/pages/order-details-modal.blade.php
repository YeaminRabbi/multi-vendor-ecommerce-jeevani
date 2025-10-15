@php
    // Initialize the total sum
    $totalSum = 0;
@endphp

<table class="w-full border border-gray-300">
    <thead>
        <tr>
            <th class="py-3 px-4 border-b text-left">Image</th>
            <th class="py-3 px-4 border-b text-left">Product Name</th>
            <th class="py-3 px-4 border-b text-left">Quantity</th>
            <th class="py-3 px-4 border-b text-left">Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orderItems as $data)
            @php
                // Calculate the subtotal for this item
                $subtotal = $data->price * $data->qty;
                $totalSum += $subtotal; // Accumulate the total sum
            @endphp
            <tr class="border-b">
                <td class="py-3 px-4">
                    <img src="{{ $data->product->featured_image_url }}" alt="{{ $data->item }}"
                        class="w-16 h-16 object-cover rounded">
                </td>
                <td class="py-3 px-4">{{ $data->item }}</td>
                <td class="py-3 px-4">{{ $data->qty }}</td>
                <td class="py-3 px-4">{{ number_format($data->price, 2) }} ৳</td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Display the total sum -->
<div class="mt-4 text-lg font-semibold">
    <span>Total:</span> <span>{{ number_format($totalSum, 2) }} ৳</span>
</div>
