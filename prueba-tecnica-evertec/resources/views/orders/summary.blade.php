@extends('layouts.app')

@section('content')
<h3>Summary</h3>
<form action="{{ route('pay') }}" method="POST">
@csrf
<input type="hidden" name="order_id" value="{{$order->id}}">
<div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Reference:</strong>
                    {{$order->reference}}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {{$order->customer_name}}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    {{$order->customer_email}}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Mobile:</strong>
                    {{$order->customer_mobile}}
                </div>
            </div> 
            <h3>Product</h3>
            <hr>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Price:</strong>
                    {{$order->price}}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    {{$order->description}}
                </div>
            </div>            
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Pay</button>
            </div>
        </div>
</form>
@endsection