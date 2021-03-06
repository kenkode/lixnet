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

@page { margin: 50px 20px; }
 .header { position: fixed; left: 0px; top: -30px; right: 0px; height: 150px;  text-align: center; }
 .content {margin-top: -30px; margin-bottom: -30px}
 .footer { position: fixed; left: 0px; bottom: -60px; right: 0px; height: 50px;  }
 
*{
  font-size: 11px !important;
}

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
    padding:8px;
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


</style>


</head>

<body>
    
<?php $currency = Currency::find(1); ?>

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
                  <strong>
                    @if($erporder->quotation_header != null || $erporder->quotation_header != "")
                    {{$erporder->quotation_header}}
                    @else
                    Quotation
                    @endif
                  </strong>
                <table class="demo" style="width:100%">
                  
                  <tr >
                    <td>Date</td><td>Quotation #</td>
                  </tr>
                  <tr>
                    <td>{{ date('m/d/Y', strtotime($erporder->date))}}</td><td>{{$erporder->order_number}}</td>
                  </tr>
                  
                </table>
            </td>
          </tr>

          
        
      </table>
      <br>
      <table class="demo" style="width:40%">
        <tr>
          <td><strong>Client</strong></td>
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




      <br>

           <table class="inv" style="width:100%">
          
           <tr>
            <td style="border-bottom:1px solid #000">Part #</td>
            <td style="border-bottom:1px solid #000">Description</td>
            <td style="border-bottom:1px solid #000">License Level</td>
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
            <td>{{ $orderitem->item->license_level}}</td>
            <td>{{ $orderitem->quantity}}</td>
            <td>{{ asMoney($orderitem->price)}}</td>
            
             <td> {{asMoney($orderitem->price * $orderitem->quantity)}}</td>
          </tr>


      @endforeach
      <!-- @for($i=1; $i<15;$i++)
       <tr>
            <td>&nbsp;</td>
            <td></td>
            <td> </td>
            <td> </td>
            <td> </td>
            
          </tr>
          @endfor -->
          <tr>
            <td style="border-top:1px solid #000" rowspan="4" colspan="4">&nbsp;</td>
            
<td style="border-top:1px solid #000" ><strong>Subtotal</strong> </td><td style="border-top:1px solid #000" colspan="1">{{$currency->shortname.' '.asMoney($total)}}</td></tr>        
             
<?php 
$grandtotal = $grandtotal + $total;
$payments = Erporder::getTotalPayments($erporder);


 ?>
           @foreach($txorders as $txorder)
           <?php $grandtotal = $total + $txorder->amount; ?>
           <tr>
            <td style="border-top:1px solid #000" ><strong>{{$txorder->name}}</strong> ({{$txorder->rate.' %'}})</td><td style="border-top:1px solid #000" colspan="1">{{$currency->shortname.' '.asMoney($txorder->amount)}}</td>
           </tr>
           @endforeach
            <tr>
            <td style="border-top:1px solid #000" ><strong>Total Amount</strong> </td><td style="border-top:1px solid #000" colspan="1">{{$currency->shortname.' '.asMoney($grandtotal-$orders->discount_amount)}}</td>

           </tr>
           
         


      
      </table>



    
  </div>


</div>
</div>


<div>
{{$erporder->quotation_details}}
</div>




   



<!-- <div class="footer" align="center">
     <p class="page">Valid for 30 days</p>
   </div> -->

<br><br>

   

</body>

</html>



