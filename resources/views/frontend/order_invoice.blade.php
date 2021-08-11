<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order PDF</title>
  <style>
    .table, th, td {border-top: 1px solid #ddd; border-bottom: 1px solid #ddd;  border-collapse: collapse;}
    th, td{padding: 0.5em; padding-right: 2em;}
    th{text-align: left; width: fit-content; white-space: nowrap;}
    td{width: 100%}
    .row{display: flex; justify-content: center;}
    .col{width: 60%;}
  </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="card bg-white">
          <div class="mt-5">
            <center><h3>{{__('Demo Invoice')}}</h3></center>
          </div>
          
          <div class="card-body">
            <table class="table">
              <tr>
                <th>Order No.</th>
                <th> : </th>
                <td>{{$order_invoice->id}}</td>
              </tr>
              <tr>
                <th>Customer</th>
                <th> : </th>
                <td>{{$order_invoice->name}}</td>
              </tr>
              <tr>
                <th>Product Name</th>
                <th> : </th>
                <td>
                  @foreach($product_details as $product)
                    {{($product->product_name)}}<br>
                    <!-- {{($product->product_name)}}@if (!$loop->last), @endif -->
                  @endforeach
                </td>
              </tr>
              <tr>
                <th>Order Date</th>
                <th> : </th>
                <td>{{$order_invoice->created_at}}</td>
              </tr>
              <tr>
                <th>Subtotal</th>
                <th> : </th>
                <td>{{$order_invoice->subtotal}}</td>
              </tr>
              <tr>
                <th>Discount</th>
                <th> : </th>
                <td>{{$order_invoice->discount}}</td>
              </tr>
              <tr>
                <th>Total</th>
                <th> : </th>
                <td>{{$order_invoice->total}}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
