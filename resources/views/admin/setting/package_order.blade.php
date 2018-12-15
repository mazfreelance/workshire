@extends('layouts.master_admin')

@section('title', 'Setting | Orders')

@section('content') 
<div class="content-wrapper">
        <!-- Container-fluid starts -->
       <div class="container-fluid">
        <!-- Row Starts -->
        <div class="row">
            <div class="col-sm-12 p-0">
                <div class="main-header">
                    <h4>Setting | Employer Orders</h4>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="icofont icofont-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="">Customers</a>
                        </li>
                        <li class="breadcrumb-item"><a href="">Orders</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- Row end -->
        <!-- Row content -->
        <div class="row">
            <div class="col-md-12">  

                @if(session('success'))
                <div class="alert alert-success" role="alert">
                  {{ session('success') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif

        		<!-- Col content-2 --> 
				<div class="card">
                    <div class="card-header">
                    	Setting for employer orders list
                    </div>  
                    <div class="card-block">
                        <div class="row">
                            <div class="col-sm-12 table-responsive"> 
                                 <div class="modal" tabindex="-1" role="dialog" id="editpackage">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Orders</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            
                                            @if(isset($editPkg))
                                            {!! Form::model($editPkg,['method'=>'put','id'=>'frm']) !!}
                                            @endif 

                                            <div class="modal-body">  
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1" class="form-control-label">Status</label>
                                                    <select class="form-control" name="status">
                                                        <option value="" selected disabled>Select status..</option>
                                                        <option value="pending" 
                                                        {{ isset($editPkg) ? $editPkg->status == 'pending'? 'selected':'' :''}}>
                                                        Pending</option>
                                                        <option value="Approved" 
                                                        {{ isset($editPkg) ? $editPkg->status == 'Approved'? 'selected':'' :''}}>
                                                        Approve</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>


                                <table class="table table-hover table-bordered table-striped"> 
                                    <thead class="table-inverse">
                                        <tr> 
                                            <th>#</th> 
                                            <th>Order</th> 
                                            <th>Product</th> 
                                            <th>Total</th> 
                                            <th>Tax</th>  
                                            <th>Quantity</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>   
                                        @if($COP->total() > 0)
                                            @foreach($COP as $cop)
                                            @php
                                            $product = \App\Model\Cart_Product::find($cop->cart__product_id);
                                            $order = \App\Model\Cart_Order::find($cop->cart__order_id);
                                            $employer = \App\Model\employer::find($order->employer_id);

                                            $jpost = \App\Model\EmployerTokenPost::where('employer_id', '=', $employer->id)->pluck('expired_date')->first();
                                            $rview = \App\Model\EmployerTokenResume::where('employer_id', '=', $employer->id)->pluck('expired_date')->first(); 
                                            @endphp
                                            <tr> 
                                                <td class="w-25">#{{ $order->id }}</td>
                                                <td class="w-25"> 
                                                    <table>
                                                        <tr>
                                                            <th>Company Name</th>
                                                            <td>{{ $employer->emp_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Buyer</th>
                                                            <td>{{ $order->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Bought by</th>
                                                            <td>{{ date('M d, Y - h:i a', strtotime($order->created_at)) }}</td>
                                                        </tr>
                                                    </table>
                                                </td> 
                                                <td class="w-25"> 
                                                     <table>
                                                        <tr>
                                                            <th>Name</th>
                                                            <td>{{ $product->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Package</th>
                                                            <td>
                                                                {{ 'P|'.$product->post_id }}
                                                                <br/>
                                                                {{ 'V|'.$product->resume_id }} 
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>  
                                                <td class="w-25"> 
                                                     {{$cop->total}}
                                                </td> 
                                                <td class="w-25"> 
                                                     {{$cop->tax}}
                                                </td> 
                                                <td class="w-25"> 
                                                     {{$cop->qty}}
                                                </td> 
                                                <td class="w-25">  
                                                    <table>
                                                        <tr>
                                                            <th>Status</th>
                                                            <td><label class="badge badge-inverse-success">{{ $order->status }}</label></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Payment method</th>
                                                            <td>{{ $order->payment_method }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Total</th>
                                                            <td>{{ $order->total }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Receipt</th>
                                                            <td> 
                                                                <div class="col-xs-4 col-md-2">
                                                                    <a href="{{ asset('public/document/receipt/').'/'.$order->payment_receipt}}" target="_blank">
                                                                      click to see
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>  
                                                <td class="w-25 text-center"> 
                                                    <button class="btn btn-flat flat-info txt-info waves-effect waves-light" 
                                                    onClick="location.href='{{ route('admin.update_orders', ['id' => $order->id]) }}'">Edit</button> 

                                                    <br/><br/>
                                                    @if(date('Y-m-d') >= $jpost AND date('Y-m-d') >= $rview)
                                                        <button class="btn btn-flat flat-success txt-success waves-effect waves-light" 
                                                        onClick="location.href='{{ route('admin.add_token_cart', ['emp_id' => $employer->id, 'post_id' => $product->post_id, 'resume_id' => $product->resume_id]) }}'">
                                                        Add Token
                                                        </button>
                                                    @else 
                                                        <button class="btn btn-flat flat-danger txt-danger waves-effect waves-light" disabled>
                                                        Add Token
                                                        </button>
                                                        <br/><span class="text-danger small">* Package not expired yet</span>
                                                    @endif
                                                </td>
                                            </tr> 
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="8">No result found.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table> 
                                <nav class="table-responsive" aria-label="pagination" style="margin-bottom:-1em">
                                    {{ $COP->links('vendor.pagination.bootstrap-4') }}
                                </nav> 
                            </div> 
                        </div>

                    </div>
                </div> 
    			<!-- Col content-2 end-->
            </div>
        </div>
        <!-- Row content end -->
    </div>
    <!-- Container-fluid ends -->
</div>
@section('css')
<style>

</style>
@endsection
@section('js')
<script> 
$(document).ready(function() {
    @if(isset($editPkg)) $('#editpackage').modal('show'); @endif
});
</script>
@endsection

@endsection