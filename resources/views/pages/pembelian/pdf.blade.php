<!doctype html>
<html lang="en">

<head>
    <title>Laravel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        table {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <h5 class="font-weight-bold text-center">Laravel PDF Report - Pembelian</h5>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Total Item</th>
                    <th>Subtotal</th>
                    <th>Diskon</th>
                    <th>Bayar</th>
                    <th>Created At</th>
                    <th>Supplier</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pembelian as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->total_item }}</td>
                    <td>{{ $item->subtotal }}</td>
                    <td>{{ $item->diskon }}</td>
                    <td>{{ $item->bayar }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->nama_supplier }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">No data available</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>