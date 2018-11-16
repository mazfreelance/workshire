@extends('layouts.master')

@section('title', 'Invoice')

@section('content')
<main class="py-0 mb-2"> 
	<div class="row my-1 mx-2">  
		<div class="col"> 
			 
                    <div class="row p-5">
                        <div class="col-md-6">
                            <img src="{{asset('public/images/icon/workshire_color.png')}}" style="width:400px;height:90px;">
                        </div>

                        <div class="col-md-6 text-right">
                            <p class="font-weight-bold mb-1">Invoice #{{$order->id}}</p>
                            <p class="text-muted">Order by: {{date('jS F, Y', strtotime($order->created_at))}}</p>
                        </div>
                    </div>

                    <hr class="my-5">
                    
                    <div class="row pb-5 p-5">
                        <div class="col-md-6">
                            <p class="font-weight-bold mb-4">Client Information</p>
                            <p class="mb-1">{{$emp->emp_name}}</p> 
                            <p>{{$emp->emp_address.', '.$emp->emp_town}}</p>
                            <p class="mb-1">{{$emp->emp_city.', '.$emp->emp_state}}</p>
                            <p class="mb-1">{{$emp->emp_zipcode}}</p>
                        </div>

                        <div class="col-md-6 text-right">
                            <p class="font-weight-bold mb-4">Payment Details</p> 
                            <p class="mb-1"><span class="text-muted">Payment Type: </span> {{$order->payment_method}}</p>
                            <p class="mb-1"><span class="text-muted">Name: </span> {{$order->name}}e</p>
                        </div>
                    </div>

                    <div class="row p-5">
                        <div class="col-md-12 table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="border-0 text-uppercase small font-weight-bold">ID</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Item</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Description</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Quantity</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Unit Cost</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{str_replace('|', ', ',$product->description)}}</td>
                                        <td>{{$order_product->qty}}</td>
                                        <td>RM{{$product->price}}</td>
                                        <td>RM{{$order->total}}</td>
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="d-flex flex-row-reverse bg-dark text-white p-4">
                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Grand Total</div>
                            <div class="h2 font-weight-light">RM{{$order_product->total}}</div>
                        </div>

                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Discount</div>
                            <div class="h2 font-weight-light">-</div>
                        </div>

                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Sub - Total amount</div>
                            <div class="h2 font-weight-light">RM{{$order_product->total}}</div>
                        </div>
                    </div>
                
		</div>   
	</div>
</main>  
@endsection