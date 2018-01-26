<?php


function asMoney($value) {
  return number_format($value, 2);
}

?>
<html >



<head>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>



    <!-- Page-Level Plugin CSS - Blank -->

    <!-- SB Admin CSS - Include with every page -->
   
   

<style>

@page { margin: 170px 20px; }
 .header { position: fixed; left: 0px; top: -150px; right: 0px; height: 150px;  text-align: center; }
 .content {margin-top: -120px; margin-bottom: -150px}
 .footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 50px;  }
 .footer .page:after { content: counter(page, upper-roman); }


  .demo {
    border:1px solid #000;
    border-collapse:collapse;
    padding:0px;
  }
  .demo th {
    border:1px solid #000;
    padding:5px;
  }
  .demo td {
    border:1px solid #000;
    padding:5px;
  }


  .inv {
    border:1px solid #000;
    border-collapse:collapse;
    padding:0px;
  }
  .inv th {
    border:1px solid #000;
    padding:5px;
  }
  .inv td {
    border-bottom:0px solid #000;
    border-right:1px solid #000;
    padding:5px;
  }

  table,h3{
    font-size:14px !important;
  }


</style>


</head>

<body>
    
<div class="content">

<div class="row">
  <div class="col-lg-12">

  <?php

  $address = explode('/', $organization->address);

 ?>

      <table class="" style="border: 0px; width:100%">

          <tr>

            <td style="width:150px">

            <img src="{{asset('public/uploads/logo/'.$organization->logo)}}" alt="logo" width="100%">
    
        </td>
          
            <td >
            {{ strtoupper($organization->name.",")}}<br>
            @for($i=0; $i< count($address); $i++)
            {{ strtoupper($address[$i])}}<br>
            @endfor
            {{$organization->phone}}<br/>
            

            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            
            <td colspan="2" >
                  <strong style="font-size:20px !important;">Invoice</strong>
                <table class="demo" style="width:100%">
                  
                  <tr >
                    <td>Date</td><td>Invoice #</td>
                  </tr>
                  <tr>
                    <td>{{ date('m/d/Y', strtotime($erporder->date))}}</td><td>{{$erporder->order_number}}</td>
                  </tr>
               <!--   <tr>
                    <td>LPO #</td><td>17/0668</td>
                 </tr>-->              
                </table>
            </td>
          </tr>

          
        
      </table>

       <div class="footer"><p class="page">Page <?php $PAGE_NUM ?> </div>

       <table style="margin-left:117px !important">
          <tr>
              <td>{{strtoupper('Bank Name : '.$organization->bank->bank_name)}}</td>
          </tr>
          <tr><td>{{strtoupper('Bank Branch Name : '.$organization->bankbranch->bank_branch_name)}}</td></tr>
          <tr><td>{{strtoupper('Bank Acc No. : '.$organization->bank_account_number)}}</td></tr>
       </table>

      <br>
      <table class="demo" style="width:40%">
        <tr>
          <td><strong>Bill To</strong></td>
        </tr>
        <tr>
          <td>{{$erporder->client->name}}<br>
          {{$erporder->client->contact_person}}<br>
           {{$erporder->client->phone}}<br>
            {{$erporder->client->email}}<br>
            {{$erporder->client->address}}<br>
          </td>
        </tr>
      </table>
      
     
      <br/>
         
         <table class="inv" style="width:100%; border-collapse:unset;">
           
           <tr>
            <td style="border-bottom:1px solid #000">Item</td>
            <td style="border-bottom:1px solid #000;width 100px !important">Description</td>
            
            <td style="border-bottom:1px solid #000">Qty</td>
            <td style="border-bottom:1px solid #000">Rate</td>
           
            <td style="border-bottom:1px solid #000">Amount</td>
          </tr>

         <?php $total = 0; $i=1;  $grandtotal=0;?>
          @foreach($erporder->erporderitems as $orderitem)

          <?php

            $amount = $orderitem['price'] * $orderitem['quantity'];
            /*$total_amount = $amount * $orderitem['duration'];*/
            $total = $total + $amount;


            ?>
          <tr>
            <td >{{ $orderitem->item->name}}</td>
            <td>{{ $orderitem->item->description}}</td>
            
            <td>{{ $orderitem->quantity}}</td>
            <td>{{ asMoney($orderitem->price)}}</td>
            <td> {{asMoney($orderitem->price * $orderitem->quantity)}}</td>
          </tr>


      @endforeach
     <!--  @for($i=1; $i<15;$i++)
       <tr>
            <td>&nbsp;</td>
            <td></td>
            <td> </td>
            <td> </td>
            <td> </td>
            
          </tr>
          @endfor -->
          <tr>
            <td style="border-top:1px solid #000" rowspan="6" colspan="3">&nbsp;</td>
            
            <td style="border-top:1px solid #000" ><strong>Subtotal</strong> </td><td style="border-top:1px solid #0000" colspan="1">KES {{asMoney($total)}}</td></tr><tr>

            <td style="border-top:1px solid #000" ><strong>Discount</strong> </td><td style="border-top:1px solid #000" colspan="1">KES {{asMoney($orders->discount_amount)}}</td>
           
<?php 
$grandtotal = $grandtotal + $total;
$payments = Erporder::getTotalPayments($erporder);


 ?>
           @foreach($txorders as $txorder)
           <?php $grandtotal = $total + $txorder->amount; ?>
           <tr>
            <td style="border-top:1px solid #000" ><strong>{{$txorder->name}}</strong> ({{$txorder->rate.' %'}})</td><td style="border-top:1px solid #000" colspan="1">KES {{asMoney($txorder->amount)}}</td>
           </tr>
           @endforeach
            <tr>
            <td style="border-top:1px solid #000" ><strong>Total Amount</strong> </td><td style="border-top:1px solid #000" colspan="1">KES {{asMoney($grandtotal-$orders->discount_amount)}}</td>
           </tr>
<!--
<tr>
            <td style="border-top:1px solid #000" ><strong>50% Paid</strong> </td><td style="border-top:1px solid #000" colspan="1">KES {{asMoney(($grandtotal-$orders->discount_amount)*0.5)}}</td>
           </tr>
<tr>
            <td style="border-top:1px solid #000" ><strong>25% Paid</strong> </td><td style="border-top:1px solid #000" colspan="1">KES {{asMoney(($grandtotal-$orders->discount_amount)*0.25)}}</td>
           </tr>
<tr>
<td style="border-top:0px !important" rowspan="6" colspan="3">&nbsp;</td>

            <td style="border-top:1px solid #000;border-bottom:1px solid #000;" ><strong>25% Amount Due</strong> </td><td style="border-top:1px solid #000;border-bottom:1px solid #000;" colspan="1">KES {{asMoney(($grandtotal-$orders->discount_amount)*0.25)}}</td>
           </tr>
-->
         

      
      </table>
<div align="center">
<p>Terms and conditions apply.</p>
</div>
    
  </div>


</div>
</div>







   



<br><br>

   

</body>

</html>



