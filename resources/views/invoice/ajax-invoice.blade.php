 <table class="table">
    <thead>
      <tr>
        <th>Invoice Num</th>
        <th>Invoice Date</th>
        <th>Product ID</th>
        <th>Product</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($invoices as $invoice)
        <tr>
        <td>{{$invoice->invoice_num}}</td>
        <td>{{$invoice->invoice_date}}</td>
        <td>{{$invoice->product_id}}</td>
        <td>{{$invoice->product_description}}</td>
        <td>{{$invoice->qty}}</td>
        <td>{{$invoice->price}}</td>
        <td>{{($invoice->qty*$invoice->price)}}</td>
      </tr>  
      @empty
        <tr>
        <td colspan="5" class="text-danger text-center">No record found.</td>
      </tr>    
      @endforelse
     <tfoot>
    
     </tfoot> 
    </tbody>
  </table>
