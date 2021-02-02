@extends('layouts.app')

@section('content')
<h3>Order Status</h3>
<div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                @if($status == 'APPROVED')
                <label class="badge badge-success">{{ $status }}</label>
                @elseif($status == 'PENDING')
                <label class="badge badge-warning">{{ $status }}</label>
                @elseif($status == 'REJECTED')
                <label class="badge badge-danger">{{ $status }}</label>
                @endif
                </div>
            </div>
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
            @if($status == 'REJECTED')
            <div class="col-xs-6 col-sm-6 col-md-6 text-center">
                <form action="{{ route('pay') }}" method="POST">
                    @csrf
                    <input type="hidden" name="order_id" value="{{$order->id}}">         
                    <button type="submit" class="btn btn-primary">Try Again</button>
                </form>
            </div>
            @endif
            @if($status == 'PENDING')         
            <div class="col-xs-6 col-sm-6 col-md-6 text-center">
                <button type="button" onclick="window.location.reload();" class="btn btn-primary">CHECK STATUS</button>
            </div>
            </form>
            @endif
            <div class="col-xs-6 col-sm-6 col-md-6 text-center">
                <button type="button" onclick="window.location = '{{ url('/') }}';" class="btn btn-primary">Back Home</button>
            </div>            
</div>
@endsection