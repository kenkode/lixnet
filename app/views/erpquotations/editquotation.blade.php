<?php
	function asMoney($value) {
	  return number_format($value, 2);
	}
?>

@extends('layouts.erp')

{{ HTML::script('media/js/jquery.js') }}
<script type="text/javascript">
	var total;
	var amnt = 0;
</script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

<!-- Include Editor style. -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/css/froala_style.min.css" rel="stylesheet" type="text/css" />

@section('content')

<div class="row">
	<div class="col-lg-12">
    	<p hidden id="status">{{$order->status}}</p>
    	<h4><font color='green'>Quote Number : {{$order->order_number}} &emsp;| &emsp;Client: {{$order->client->name}}  &emsp; |&emsp; Date: {{$order->date}} &emsp; |&emsp; Status: {{$order->status}} </font> </h4>
		<hr>
	</div>	
</div>

<div class="row">
	<form class="form-inline" method="POST" id="addItem" action="{{{URL::to('erpquotations/edit/add')}}}">
		<div class="col-lg-12">
			<label>Add Items</label><br>
			<font color="red"><i>All fields marked with * are mandatory</i></font><br>
			<input type="hidden" name="order_id" value="{{$order->id}}">
			<div class="form-group">
				<label>Item&nbsp;<span style="color:red">*</span> :&emsp;</label>
	            <select id="itemName" name="item_id" class="form-control input-sm" required>
	            <option value=""> ------- select item ------- </option>
	                @foreach($items as $item)
	                    <option value="{{$item->id}}">{{$item->name}}</option>
	                @endforeach
	            </select>
			</div>&emsp;
			<div class="form-group ">
	            <label>Quantity&nbsp;<span style="color:red">*</span> :&emsp;</label>
	            <input type="text" id="qty" name="quantity" class="form-control input-sm" required>
	        </div>&emsp;
	        <div class="form-group ">
	            <input type="image" name="submit" src="{{asset('images/Add-icon.png')}}" alt="Submit" width="15%">
	        </div>
		</div>
	</form>
</div>
<hr>

<?php 
$error = Session::get('error');
Session::forget('error');
?>
@if(isset($error))
<div class="col-lg-12">
    <div class="alert alert-danger fade in" style="font-size: 15px;">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Error!</strong> {{$error}}
    </div> 
</div>
@endif

<div class="row">
	<div class="col-lg-12">
		<form role="form" action="{{{URL::to('erpquotations/edit/'.$order->id)}}}" method="POST">
			<table class="table table-bordered table-condensed">
				<thead>
					<th>Item</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Amount</th>
					<th>Action</th>
				</thead>
				<tbody>
					<?php $total=0; $count=0; ?>
					@foreach($order->erporderitems as $orderitem)
						<?php 
							$amount = $orderitem['price'] * $orderitem['quantity'];
			                $total = $total + $amount;
						?>

						<tr>
							<td>{{$orderitem->item->name}}</td>
							<td>
								<input type="number" id="newQty{{$count}}" class="form-control input-sm" name="newQty{{$orderitem->item_id}}" value="{{$orderitem['quantity']}}" onkeyup="calculate({{$count}});" onblur="getTotal({{$count}});" onfocus="removeCount({{$count}})">
							</td>
							<td id="{{$count}}">
								<input type="text" id="newPrice{{$count}}" class="form-control input-sm" name="newPrice{{$orderitem->item_id}}" value="{{$orderitem['price']}}" onkeyup="calculate({{$count}});" onblur="getTotal({{$count}});" onfocus="removeCount({{$count}})">
							</td>
							<!--<td id="{{$count}}">{{asMoney($orderitem['price'])}}</td>-->
							<td id="amount{{$count}}">{{asMoney($amount)}}</td>	
							<td>
								<div class="btn-group">
                  	<a href="{{URL::to('erpquotations/delete/'.$order->id.'/'.$orderitem->id)}}" class="btn btn-danger btn-sm" onclick="return (confirm('Are you sure you want to remove this item?'))"> Remove </a>
                </div>
							</td>	
						</tr>

						<?php $count++; ?>
					@endforeach
				</tbody>
			</table>
			
			<table border="0" align="right" style="width:400px; box-shadow:none" class="tb-none">
				<tr style="height:50px"><td>Discount:</td><td colspan="2"> <input type="text" name="discount" id="discount" onkeypress="grandTotal()" onkeyup="grandTotal()" onblur="grandTotal()" value="{{$order->discount_amount}}" class="form-control"></td></tr>
				<tr style="height:50px"><td><strong>Payable Amount</strong></td><td colspan="2"> <input type="text" readonly="readonly" name="payable" id="payable" value="{{$total-($order->discount_amount);}}" class="form-control"></td></tr>

				<?php $i = 1; ?>
				@foreach($taxes as $tax)
					<tr style="height:50px">
              <td>{{$tax->name}}</td>
              @if(count(TaxOrder::getAmount($tax->id,$order->order_number)) > 0)
              		<td><input type="checkbox" class="checkbox" name="rate[]" id="{{'rate_'.$i}}" value="{{$tax->id}}" checked></td>
              @else
              		<td><input type="checkbox" class="checkbox" name="rate[]" id="{{'rate_'.$i}}" value="{{$tax->id}}"></td>
              @endif
              @if(count(TaxOrder::getAmount($tax->id,$order->order_number)) > 0)
                  <td><input type="text" readonly="readonly" name="tax[]" id="{{'tax_amount_'.$i}}" value="{{TaxOrder::getAmount($tax->id,$order->order_number)}}" class="form-control tax_check"></td>
              @else
                  <td><input type="text" readonly="readonly" name="tax[]" id="{{'tax_amount_'.$i}}" value="0" class="form-control tax_check"></td>
              @endif
          </tr>

				
					<script type="text/javascript">
						$(document).ready(function(){
							grandTotal();
							/* CALCULATE VAT */
							function calVAT(){
								if($('#rate_'+<?php echo $i;?>).is(":checked")){
						    		$('#rate_'+<?php echo $i;?>+':checked').each(function(){
						    			$.get("{{ url('api/getrate')}}", 
						    			{ option: $(this).val() }, 
						    			function(data) {
						    				//console.log(data);
						    				total= ($("#payable").val()*data)/100;
						     				$("#tax_amount_"+<?php echo $i;?>).val(total);
						      				grandTotal();
						      			});
						      		});
						     	}else{
						        	$("#tax_amount_"+<?php echo $i;?>).val(0);
						        	grandTotal();
						     	}
							}

							//console.log(($('#rate_'+<?php echo $i;?>+':checked')).val());
						    $('#rate_'+<?php echo $i;?>).click(function(){
						    	var total = 0;  
						    	calVAT();
						    });
						});
					</script>

				<?php $i++; ?>
				@endforeach
				
				<tr style="height:50px"><td><strong>Grand Total</strong></td><td colspan="2"><input type="text" name="grand" id="grand" readonly="readonly" value="{{$total-Input::get('discount')}}" class="form-control"></td></tr>
			
			</table>
						
			<script type="text/javascript">
				var totalA = <?php echo $total; ?>;
				var disc = $('#discount').val();
				if(disc === 0){
					total = totalA;
				} else{
					total = totalA - disc;
				}

				function calculate(itemNum){
					var newQty = $("#newQty"+itemNum).val();
					var newPrice = $("#newPrice"+itemNum).val();
					//var itemPrice = $("#"+itemNum).text().replace(/,/g, '');
					//var itemPrice = $("newPrice"+itemNum).val().replace(/,/g, '');
					//var amnt = $("#amount<?php echo $count; ?>").text();
					console.log(newQty);
					var totalAmnt = (newQty * newPrice);
					$("#amount"+itemNum).text((totalAmnt+".00" + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
				}

				// onfocusOut - add
				function getTotal(itemNum){
					var itemTotal = $("#amount"+itemNum).text().replace(/,/g, '');
					total = total + parseFloat(itemTotal);
					//$('#newQty'+itemNum).addClass('changed');
					$('#payable').val(total);
					getTax();
					grandTotal();
				}

				// on focusIn - subtract
				function removeCount(itemNum){
					var itemTotal = $("#amount"+itemNum).text().replace(/,/g, '');
					total = total - parseFloat(itemTotal);
					$('#payable').val(total);
					getTax();
					grandTotal();

					/*if($('#newQty'+itemNum).hasClass('changed')){
						total = total - parseFloat(itemTotal);
						$('#payable').val(total);
					} else{
						total = total;
						$('#payable').val(total);
					}*/
				}

				function getTax(){
					var i = <?php echo $i-1; ?>;
			    	for(var count=1; count<=i; count++){
							if($('#rate_'+count).is(":checked")){
					    		$('#rate_'+count+':checked').each(function(){
					    				var tax = 0;
					    				var value = $(this).val();
					    				$.get("{{ url('api/getrate')}}", 
					    				{ option: $(this).val() }, 
					    				function(data) {
						    				//console.log(data);
						    				tax= ($("#payable").val()*data)/100;
						     				$("#tax_amount_"+value).val(tax);
						      				grandTotal();
						      				//console.log("#tax_amount_"+value);
						      		});
					      	});
				     	}else{
				        	$("#tax_amount_"+count).val(0);
				        	grandTotal();
				     	}
					}
				}

			</script>

			
			<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
			<h3>Additional Details</h3>
			<div class="form-group">
            <label for="username">Invoice Header :</label>
            <input class="form-control" placeholder="" type="text" name="invoice_header" id="invoice_header" value="{{$order->invoice_header}}">
        </div>

        <div class="form-group">
            <label for="username">Quotation Header :</label>
            <input class="form-control" placeholder="" type="text" name="quotation_header" id="quotation_header" value="{{$order->quotation_header}}">
        </div>

         <div class="form-group">
            <label for="username">Other Details:</label>
            <textarea rows="20" class="form-control" name="quotation_details" id="quotation_details" >{{$order->quotation_details}}</textarea>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			    
			    		<hr>
			        <a class="btn btn-danger btn-sm" href="{{ URL::to('erpquotations/show/'.$order->id)}}">Cancel </a>
			        <input type="submit" class="btn btn-primary btn-sm pull-right" value="Process"/>
			 		</div>
		 	</div>
		 </div>
		</form>
	</div>
</div>

<!-- Include jQuery lib. -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<!-- Include Editor JS files. -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1//js/froala_editor.pkgd.min.js"></script>

<!-- Initialize the editor. -->
<script>
  $(function() {
    $('textarea').froalaEditor()
  });
</script>

<script type="text/javascript">
	$(document).ready(function(){
	    $("#discount").keypress(function(){
		    var pay = <?php echo $total ?>-this.value;
		    $("#payable").val(pay);
		    getTax();
		    grandTotal();
	    });
	    
	    $("#discount").keyup(function(){
		    var pay = <?php echo $total ?>-this.value;
		    $("#payable").val(pay);
		    getTax();
		    grandTotal();
	    });
	});

</script>

<?php $i = 1; ?>
@foreach($taxes as $tax)
<script type="text/javascript">
	function grandTotal(){
		var discount = document.getElementById("discount").value;
		var payable = document.getElementById("payable").value;
		var tax = 0;
		for (var i = 1; i <= document.getElementsByName("tax[]").length;  i++) {
			tax+=parseFloat(document.getElementById("tax_amount_"+i).value);
		};
		 
		var total = <?php echo $total ?>;
		var grand = parseFloat(payable)+parseFloat(tax);
		//console.log(tax);
		document.getElementById("grand").value=grand;
	}
</script>
<?php $i++; ?>
@endforeach

@stop