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
        
        tr:nth-child(even) {
            background-color: #f2f2f2;
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
        <h1>CV. Tirta Rahayu</h1>
        <div class="title">Penjualan</div>
        <div class="description">Laporan Penjualan Tanggal {{ date('d M Y', strtotime($startDay)) }} Sampai {{ date('d M Y', strtotime($endDay)) }} </div>
    </div>
    
    <div class="footer">
      &copy; {{ date('Y') }} Tirta Rahayu. All rights reserved.
    </div>

    <div class="content">
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Dibuat Oleh</th>
                    <th>Customer</th>
                    <th>Salesman</th>
                    <th>Total Item</th>
                    <th>Discount</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp
    
                @forelse($penjualan as $item)
                <tr>
                    <td>{{ date('d M Y', strtotime($item->created_at)) }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->nama_customer }}</td>
                    <td>{{ $item->nama_salesman }}</td>
                    <td>{{ $item->total_item }}</td>
                    <td>{{ $item->diskon }}%</td>
                    <td>Rp.{{ $item->subtotal }}</td>
                </tr>
                @php
                    $total += $item->subtotal; 
                @endphp
                @empty
                <tr>
                    <td colspan="7">No data available</td>
                </tr>
                @endforelse
    
                @if(count($penjualan) > 0)
                <tr>
                    <td colspan="6"></td>
                    <td>Total : Rp. {{ number_format($total, 2) }}</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>
