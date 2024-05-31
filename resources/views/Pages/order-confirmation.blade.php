<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Order Confirmation</h1>
    <p>Dear {{ $name }},</p>
    <p>Thank you for your order. Here are the details:</p>
    <ul>
        <li>Order ID: {{ $orderId }}</li>
        <li>Name: {{ $name }}</li>
        <li>Address: {{ $street }}, {{ $city }}</li>
        <li>Phone: {{ $phone }}</li>
        <li>Email: {{ $email }}</li>
        <li>Payment Mode: {{ $paymentMode }}</li>
        <li>Total Price: {{ $totalPrice }}</li>
    </ul>

    <p>Best regards,<br>
    Elegantic</p>
</body>
</html>
