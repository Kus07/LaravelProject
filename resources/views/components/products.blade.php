<table border = 1>
        <tr>
            <th>Name</th>
            <th>Quantity</th>
        </tr>
        

        @foreach($products as $product)
            <tr>
                <th>{{$product['name']}}</th>
                <th>{{$product->quantity}}</th>
            </tr>
        @endforeach
    </table>