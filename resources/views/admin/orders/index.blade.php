@extends('adminlte::page')

@section('title', 'Narudžbine')

@section('content_header')
    <h1>Sve narudžbine</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kupac</th>
                    <th>Grad</th>
                    <th>Ukupno</th>
                    <th>Status</th>
                    <th>Datum</th>
                    <th>Akcije</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                    <td>{{ $order->city }}</td>
                    <td>{{ number_format($order->total_price, 2) }} RSD</td>
                    <td>
                        <span class="badge {{ $order->status == 'Na čekanju' ? 'badge-warning' : 'badge-success' }}">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary">Pogledaj</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop