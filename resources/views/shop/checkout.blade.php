@extends('layouts.app')

@section('content')
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Kasa (Checkout)</h1>
            </div>
        </div>
    </div>
</section>

<section class="checkout_area section_gap">
    <div class="container">
        <div class="billing_details">
            <form class="row contact_form" action="{{ route('checkout.place') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <h3>Podaci za dostavu</h3>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" name="first_name" placeholder="Ime" required>
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" name="last_name" placeholder="Prezime" required>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" name="address" placeholder="Adresa stanovanja" required>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" name="city" placeholder="Grad" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <textarea class="form-control" name="message" rows="2" placeholder="Napomena (opciono)"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>Vaša narudžbina</h2>
                            <ul class="list">
                                <li><a href="#">Proizvod <span>Ukupno</span></a></li>
                                @foreach(session('cart') as $id => $details)
                                    <li><a href="#">{{ $details['name'] }} <span class="middle">x {{ $details['quantity'] }}</span> <span class="last">{{ number_format($details['price'] * $details['quantity'], 2) }}</span></a></li>
                                @endforeach
                            </ul>
                            <ul class="list list_2">
                                <li><a href="#">Ukupno <span>{{ number_format(array_sum(array_map(function($item) { return $item['price'] * $item['quantity']; }, session('cart'))), 2) }} RSD</span></a></li>
                            </ul>
                            <button type="submit" class="primary-btn w-100" style="border:none;">Potvrdi narudžbinu</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection