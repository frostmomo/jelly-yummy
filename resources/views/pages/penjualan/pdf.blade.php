{{-- <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 1</title>
    <link rel="stylesheet" href="" media="all" />
  </head>
  <body>
    <img src="{{ storage_path('app/public/trb.png') }}">
    <header class="clearfix">
      <div id="logo">
      </div>
      <h1>INVOICE 3-2-1</h1>
      <div id="company" class="clearfix">
        <div>Company Name</div>
        <div>455 Foggy Heights,<br /> AZ 85004, US</div>
        <div>(602) 519-0450</div>
        <div><a href="mailto:company@example.com">company@example.com</a></div>
      </div>
      <div id="project">
        <div><span>PROJECT</span> Website development</div>
        <div><span>CLIENT</span> John Doe</div>
        <div><span>ADDRESS</span> 796 Silver Harbour, TX 79273, US</div>
        <div><span>EMAIL</span> <a href="mailto:john@example.com">john@example.com</a></div>
        <div><span>DATE</span> August 17, 2015</div>
        <div><span>DUE DATE</span> September 17, 2015</div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">SERVICE</th>
            <th class="desc">DESCRIPTION</th>
            <th>PRICE</th>
            <th>QTY</th>
            <th>TOTAL</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="service">Design</td>
            <td class="desc">Creating a recognizable design solution based on the company's existing visual identity</td>
            <td class="unit">$40.00</td>
            <td class="qty">26</td>
            <td class="total">$1,040.00</td>
          </tr>
<!-- forloophere -->
          <tr>
            <td colspan="4">SUBTOTAL</td>
            <td class="total">$5,200.00</td>
          </tr>
          <tr>
            <td colspan="4">TAX 25%</td>
            <td class="total">$1,300.00</td>
          </tr>
          <tr>
            <td colspan="4" class="grand total">GRAND TOTAL</td>
            <td class="grand total">$6,500.00</td>
          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laravel PDF Report - Penjualan</title>
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
        <h5 class="font-weight-bold text-center">Laravel PDF Report - Penjualan</h5>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Total Item</th>
                    <th>Subtotal</th>
                    <th>Diskon</th>
                    <th>Created At</th>
                    <th>User</th>
                    <th>Customer</th>
                    <th>Salesman</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penjualan as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->total_item }}</td>
                    <td>{{ $item->subtotal }}</td>
                    <td>{{ $item->diskon }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->nama_customer }}</td>
                    <td>{{ $item->nama_salesman }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
