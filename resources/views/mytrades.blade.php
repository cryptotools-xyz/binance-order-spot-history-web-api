<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    
    <table class="table">
        <thead>
            <tr>
                <th>symbol</th>
                <th>id</th>
                <th>orderId</th>
                <th>type</th>
                <th>side</th>
                <th>orderListId</th>
                <th>price</th>
                <th>qty</th>
                <th>quoteQty</th>
                <th>commission</th>
                <th>commissionAsset</th>
                <th>time</th>
                <th>isBuyer</th>
                <th>isMaker</th>
                <th>isBestMatch</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $item->symbol }}</td>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->orderId }}</td>
                    <td>{{ $item->order->type }}</td>
                    <td>{{ $item->order->side }}</td>
                    <td>{{ $item->orderListId }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>{{ $item->quoteQty }}</td>
                    <td>{{ $item->commission }}</td>
                    <td>{{ $item->commissionAsset }}</td>
                    <td><?= date('d M Y H:i:s', $item->time / 1000); ?></td>
                    <td>{{ $item->isBuyer }}</td>
                    <td>{{ $item->isMaker }}</td>
                    <td>{{ $item->isBestMatch }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>

