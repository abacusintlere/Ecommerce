<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Confirmation Email</title>
</head>
<body>
    
    <p>Hi {{ $order->firstname }} {{ $order->lastname }},</p>
    <p>Your Order Has Been Shipped.</p>

    <br>

    <table style="width:600px; text-align:right;">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>

        @foreach ($order->orderItems as $item)
            <tr>
                <td>
                    <img src="{{ asset('assets/images/products') }}/{{ $item->product->thumbnail }}" alt="{{ $item->product->name }}" width="100">
                </td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{ $order->price }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3" style="border-top:1px solid #ccc;"></td>
            <td style="font-size:15px; font-weight:bold;border-top:1px solid #ccc;">Subtotal : ${{ $order->subtotal }}</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td style="font-size:15px; font-weight:bold;">Tax : ${{ $order->tax }}</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td style="font-size:15px; font-weight:bold;">Shipping : Free Shipping</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td style="font-size:22px; font-weight:bold;">Total : ${{ $order->total }}</td>
        </tr>
    </table>
</body>
</html>