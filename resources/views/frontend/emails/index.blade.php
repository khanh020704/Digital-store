<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	
<h2>{{ $data['subject'] }}</h2>

<p>{{ $data['body'] }}</p>
<table border="1" cellpadding="10" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data['cart'] as $item)
        <tr>
            <td>{{ $item['name'] }}</td>
            <td>${{ number_format($item['price']) }}</td>
            <td>{{ $item['qty'] }}</td>
            <td>${{ number_format($item['price'] * $item['qty']) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<br>

<p><strong>Sub Total:</strong> ${{ number_format($data['total']) }}</p>
<p><strong>Eco Tax:</strong> ${{ number_format($data['ecoTax']) }}</p>
<p><strong>Grand Total:</strong> ${{ number_format($data['grandTotal']) }}</p>



</body>
</html>