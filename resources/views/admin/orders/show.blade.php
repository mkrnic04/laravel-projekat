@extends('adminlte::page')

@section('title', 'Detalji narudžbine')

@section('content_header')
    <h1>Narudžbina #{{ $order->id }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title">Podaci o kupcu</h3>
            </div>
            <div class="card-body">
                <strong>Ime i prezime:</strong> {{ $order->first_name }} {{ $order->last_name }} <br>
                <strong>Adresa:</strong> {{ $order->address }} <br>
                <strong>Grad:</strong> {{ $order->city }} <br>
                <strong>Datum:</strong> {{ $order->created_at->format('d.m.Y H:i') }}
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-info">
                <h3 class="card-title">Status narudžbine</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <select name="status" class="form-control">
                            <option value="Na čekanju" {{ $order->status == 'Na čekanju' ? 'selected' : '' }}>Na čekanju</option>
                            <option value="Poslato" {{ $order->status == 'Poslato' ? 'selected' : '' }}>Poslato</option>
                            <option value="Otkazano" {{ $order->status == 'Otkazano' ? 'selected' : '' }}>Otkazano</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Ažuriraj status</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-dark">
                <h3 class="card-title">Naručeni proizvodi</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Slika</th>
                            <th>Proizvod</th>
                            <th>Cena</th>
                            <th>Količina</th>
                            <th>Ukupno</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td><img src="{{ asset($item->product->image) }}" width="50"></td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ number_format($item->price, 2) }} RSD</td>
                            <td>x {{ $item->quantity }}</td>
                            <td>{{ number_format($item->price * $item->quantity, 2) }} RSD</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-right">UKUPNO:</th>
                            <th>{{ number_format($order->total_price, 2) }} RSD</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Nazad na listu</a>
    </div>
</div>
@stop