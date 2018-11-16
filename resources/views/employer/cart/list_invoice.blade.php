@extends('layouts.master')

@section('title', 'Profile')

@section('content')
<main class="py-0 mb-2"> 
	<div class="row my-1 mx-2">  
        <div class="col-sm-12 pl-sm-5 pt-sm-1 pt-0 pl-4">
            <h3><i class="fas fa-file-invoice"></i> Invoice</h3> 
            <hr style="margin-bottom:0.1em">
        </div> 
		<div class="col">  
            

			<div class="card">
                <div class="card-body p-0">
                    <div class="row p-5">
                        <div class="col-md-12 table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="border-0 text-uppercase small font-weight-bold">Invoice ID</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Detail</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Paid by</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Order by</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Total</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Action</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <?php 
                                        $order_product = App\Model\Cart_Order_Product::where('cart__order_id', '=', $order->id)->first();
                                        $product = App\Model\Cart_Product::find($order_product->cart__product_id);
                                        ?>
                                    <tr>
                                        <td class="w-10">#{{$order->id}}</td>
                                        <td class="w-50">{{$product->name}}</td>
                                        <td class="w-25">{{$order->name}}</td>
                                        <td class="w-50">{{date('M d, Y - H:i:s', strtotime($order->created_at))}}</td>
                                        <td>RM{{$order->total}}</td> 
                                        <td class="w-25"> 
                                            <button class="btn btn-sm btn-success"
                                                    onclick="location.href='{{ url('employer/invoice').'/'.str_replace(' ', '_', $order->created_at)}}'">
                                                <i class="fas fa-print"></i>
                                            </button> 
                                        </td>
                                    </tr> 
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
		</div>   
	</div>
</main>
<!-- Footer -->  
@include('includes.footer') 

@endsection 