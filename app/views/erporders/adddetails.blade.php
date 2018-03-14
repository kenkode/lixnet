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
	<form role="form" action="{{{URL::to('erporder/receipt/edit/'.$order->id)}}}" method="POST">
			
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
			<h3>Additional Details</h3>
			<div class="form-group">
            <label for="username">Header :</label>
            <input class="form-control" placeholder="" type="text" name="header" id="header" value="{{$order->sale_header}}">
        </div>


         <div class="form-group">
            <label for="username">Other Details:</label>
            <textarea rows="20" class="form-control" name="sale_details" id="sale_details" >{{$order->sale_details}}</textarea>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			    
			    		<hr>
			      
			        <input type="submit" class="btn btn-primary btn-sm pull-left" value="Submit"/>
			 		</div>
		 	
		</form>
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


@stop