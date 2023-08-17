<!DOCTYPE html>
<html>
<head>
    <style>
        /* Add your styling here */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .header img {
            max-width: 150px;
        }
        
        .title {
            font-size: 24px;
            margin-bottom: 10px;
        }
        
        .description {
            font-size: 14px;
            margin-bottom: 20px;
        }
        
        .content {
            margin: 20px;

        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        .footer {
            text-align: center;
            font-size: 12px;
            position: fixed;
            bottom: 20px;
            width: 100%;
        }

        @page {
            size: A4;
            margin: 0;
        }
        
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ storage_path('app/public/trb.png') }}">
        <div class="title">Pembelian</div>
        <div class="description">Report pembelian pada {{$startMonth}} sampai {{$endMonth}}.</div>
    </div>
    
    <div class="footer">
      &copy; {{ date('Y') }} Tirta Rahayu. All rights reserved.
    </div>

    <div class="content">
        <table>
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
                @forelse($pembelian as $item)
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
