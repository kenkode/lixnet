<style type="text/css" media="screen">
  .quicklink{
    text-align: center;
  }

  .quicklink div{
      font-weight: 400;
  }

  .quicklink a{
      width: 100%;
      padding: 15px 5px;
      color: #FFF;
      transition: all linear 0.25s;
  }

  .quicklink a:hover{
      color: #FFF;
      transform: translateY(-5px);
      box-shadow: 0px 1px 2px rgba(0,0,0,0.3);
      filter: brightness(90%);
  }
  
</style>

@extends('layouts.erp')
@section('content')

<br><br>
<div class="row">
      <div class="col-md-2 col-md-offset-1 quicklink">
        <a class="btn btn-default btn-icon input-block-level" href="{{ URL::to('items/create')}}" style="background: #e74c3c">
          <i class="fa fa-barcode fa-2x"></i>
          <div>New Item</div>
          
        </a>
      </div>

      <div class="col-md-2 quicklink">
        <a class="btn btn-default btn-icon input-block-level" href="{{ URL::to('clients/create')}}" style="background: #2ECC71">
          <i class="fa fa-user fa-2x"></i>
          <div>New Client</div>
          
        </a>
      </div>


      <div class="col-md-2 quicklink">
        <a class="btn btn-default btn-icon input-block-level" href="{{URL::to('checks/create')}}" style="background: #9B59B6">
          <i class="fa fa-random fa-2x"></i>
          <div>New Checkout</div>
          
        </a>
      </div>

      <div class="col-md-2 quicklink">
        <a class="btn btn-default btn-icon input-block-level" href="{{ URL::to('bookings/create')}}" style="background: #F39C12">
          <i class="fa fa-th fa-2x"></i>
          <div>New Booking</div>
          
        </a>
      </div>
      
      

      <div class="col-md-2 quicklink">
        <a class="btn btn-default btn-icon input-block-level" href="{{ URL::to('maintenances/create')}}" style="background: #34495E">
          <i class="fa fa-th-large fa-2x"></i>
          <div>New Maintenance</div>
          
        </a>
      </div>
      
    </div>

<!-- <div class="row" style="padding-right: 8.33%;">
  <div class="col-md-3 col-sm-3 col-xs-3 col-md-offset-1 col-xs-offset-2 quicklink">
    <a href="{{ URL::to('items/create')}}"><img border="0" src="{{asset('images/Add-icon.png')}}" alt="New Item" width="75">
      
      <div>New Item</div>
      
    </a>
  </div>

  <div class="col-md-3 col-sm-3 col-xs-3 col-md-offset-1 col-xs-offset-2 quicklink">
    <a href="{{ URL::to('clients/create')}}"><img border="0" src="{{asset('images/addclients.png')}}" alt="New Client" width="75">
     
      <div>New Client</div>
      
    </a>
  </div>

  <div class="col-md-3 col-sm-3 col-xs-3 col-md-offset-1 col-xs-offset-2 quicklink">
    <a href="{{URL::to('salesorders/create')}}"><img border="0" src="{{asset('images/addsale.jpg')}}" alt="New Sale" width="75">
    
      <div>New Sale</div>
     
    </a>
  </div>

  <div class="col-md-3 col-sm-3 col-xs-3 col-md-offset-1 col-xs-offset-2 quicklink">
    <a  href="{{ URL::to('purchaseorders/create')}}"><img border="0" src="{{asset('images/cart-add-icon.png')}}" alt="New Purchase" width="75">
      
      <div>New Purchase</div>
      
    </a>
  </div>
  
  <div class="col-md-3 col-sm-3 col-xs-3 col-md-offset-1 col-xs-offset-2 quicklink">
    <a href="{{ URL::to('payments/create')}}"><img border="0" src="{{asset('images/payments.png')}}" alt="New Payment" width="75">
      
      <div>New Payment</div>
      
    </a>
  </div>

  <div class="col-md-3 col-sm-3 col-xs-3 col-md-offset-1 col-xs-offset-2 quicklink">
    <a href="{{ URL::to('stocks/create')}}"><img border="0" src="{{asset('images/receivestock.jpg')}}" alt="New Payment" width="75">
      
      <div>Receive Stock</div>
      
    </a>
  </div>

</div> -->



<br><br>
<hr>
<div class="row">
              						
<div class="col-lg-2"></div>
	<div class="">
		<img class="img-responsive" src="{{asset('images/ourlogo.png')}}" width="auto">
    
	</div>
</div>

@stop