@extends('layout.app')
@section('content')
<section class="content">
  <div class="container mt-5">
      <form id="invoice-filter-form" action="" method="POST" >
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
                <label for="relative_date">Relative Date</label>
                <select class="form-control" name="relative_date" id="relative_date">
                  <option value="">Select date </option>
                  <option value="last_month_to_date">Last Month to Date</option>
                  <option value="this_month">This Month</option>
                  <option value="this_year">This Year</option>
                  <option value="last_year">Last Year</option>
                </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
                <label for="client_id">Client</label>
                <select class="form-control" name="client_id" id="client_id">
                  <option value="">Select Client</option>
                  @foreach ($clients as $client)    
                  <option value="{{$client->client_id}}">{{$client->client_name}}</option>
                  @endforeach
                </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
                <label for="product_id">Product</label>
                <select class="form-control" name="product_id" id="product_id">
                  <option value="">Please select product</option>
                </select>
            </div>
          </div>

          <div class="col-md-12">
             <button class="btn btn-success" type="submit" id="filter">Filter </button>
          </div>
        </div>
      </div>  
      </form>


  <h2>Invoices</h2> 
    <div id="table-container" class="table table-responsive ">
    {!! $invoiceList !!}
    <table>
</div>

</section>
@endsection

@section('js')
@endsection