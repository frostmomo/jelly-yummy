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
        <div class="title">Keuangan</div>
        <div class="description">Laporan Keuangan Tanggal {{ date('d M Y', strtotime($startDay)) }} Sampai {{ date('d M Y', strtotime($endDay)) }} </div>
    </div>
    
    <div class="footer">
      &copy; {{ date('Y') }} Tirta Rahayu. All rights reserved.
    </div>

    <div class="content">
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Kode Akun</th>
                    <th>Uraian</th>
                    <th>Keterangan</th>
                    <th>Debit</th>
                    <th>Kredit</th>
                    <th>Saldo</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                    $saldo = 0;
                @endphp
    
                @foreach($keuangan as $datakeuangan)
                <tr>
                <td>{{ date('d M Y', strtotime($datakeuangan['created_at'])) }}</td>
                <td>{{ $datakeuangan['kode_akun'] }}</td>
                <td>{{ $datakeuangan['uraian'] }}</td>
                <td>{{ $datakeuangan['keterangan'] }}</td>
                @if($datakeuangan['tipe_transaksi'] == 'Debit')
                    @php($saldo += $datakeuangan['subtotal'])
                    <td>Rp.{{ number_format($datakeuangan['subtotal'], 2) }}</td>
                @else
                    <td>Rp.0</td>
                @endif
                @if($datakeuangan['tipe_transaksi'] == 'Kredit')
                    @php($saldo -= $datakeuangan['subtotal'])
                    <td>Rp.{{ number_format($datakeuangan['subtotal'], 2) }}</td>
                @else
                    <td>Rp.0</td>
                @endif
                <td>Rp.{{ number_format($saldo, 2) }}</td>
                </tr>
                @endforeach
    
                @if(count($keuangan) > 0)
                <tr>
                    <td colspan="6"></td>
                    <td>Saldo : Rp. {{ number_format($saldo, 2) }}</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>
