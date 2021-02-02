@extends('layouts.app')

@section('content')
<h3>Orders</h3>
<div class="pull-right">
    <a class="btn btn-success" href="{{ route('create') }}" title="Create Order"> <i class="fas fa-plus-circle"></i> Create Order
    </a>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <table class="table table-bordered table-responsive-lg">
            <tr>
                <th>No</th>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Date Created</th>
            </tr>
            @forelse ($orders as $order)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->customer_email }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ date_format($order->created_at, 'jS M Y H:i:s') }}</td>
                </tr>
            @empty     
                <tr>
                    <td colspan="4">No orders yet.</td>
                </tr>           
            @endforelse
        </table>
    </div>
</div>
@endsection