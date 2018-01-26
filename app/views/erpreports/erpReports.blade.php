<style type="text/css" media="screen">
  ul.reports{
    padding-left: 15px;
  }
  ul.reports li{
    list-style: none;
    width: 45%;
    min-width: 300px;
  }

  ul.reports li a{
    display: block;
    padding: 5px 7px;
    transition: all linear 0.3s;
  }

  ul.reports li a:hover{
    text-decoration: none;
    transform: translateX(10px);
    transition: all linear 0.3s;
  }

</style>

@extends('layouts.erp_ports')
@section('content')

<div class="row">
    <div class="col-lg-12">
  <h3>Erp Reports</h3>

<hr>
</div>  
</div>

<div class="row">
    <div class="col-lg-12">

    <ul class="reports">
      <li>
            <a href="{{ URL::to('erpReports/selectSalesPeriod') }}">Sales</a>
       </li>

       <li>
            <a href="{{ URL::to('erpReports/sales_summary') }}" target="_blank">Sales Summary</a>
       </li> 

       <li>
            <a href="{{ URL::to('erpReports/selectPurchasesPeriod') }}">Purchases</a>
       </li>

       <li>
            <a href="{{ URL::to('erpReports/selectClientsPeriod') }}">Clients</a>
       </li>

       <li>
          <a href="{{ URL::to('erpReports/selectItemsPeriod') }}">Items</a>
       </li>

       <li>
          <a href="{{ URL::to('erpReports/selectExpensesPeriod') }}">Expenses</a>
       </li>
    
       <li>
          <a href="{{ URL::to('erpReports/paymentmethods') }}" target="_blank">Payment Methods</a>
       </li>  

       <li>
         <a href="{{ URL::to('erpReports/selectPaymentsPeriod') }}">Payments</a>     
       </li>

        <li>
         <a href="{{ URL::to('erpReports/locations') }}" target="_blank">Stores</a>     
       </li> 

        <li>
         <a href="{{ URL::to('erpReports/stocks') }}" target="_blank">Stock report </a>      
       </li>

        <li>
         <a href="{{ URL::to('erpReports/pricelist') }}" target="_blank">Price List </a>     
       </li>

        <li>
         <a href="{{ URL::to('erpReports/accounts') }}" target="_blank">Account Balances </a>     
       </li> 

      <li>
        <a href="reports/blank" target="_blank">Blank report template</a>
      </li>
    </ul>

  </div>

</div>

@stop