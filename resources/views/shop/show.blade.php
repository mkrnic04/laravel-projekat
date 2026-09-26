@extends('layouts.app')

@section('title', $product->name)

@section('content')
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Detalji proizvoda</h1>
            </div>
        </div>
    </div>
</section>
<div class="product_image_area mt-5 mb-5">
    <div class="container">
        <div class="row s_product_inner">
            <div class="col-lg-6">
                <div class="single-prd-item shadow-sm text-center p-3" style="border: 1px solid #f2f2f2; border-radius: 15px;">
                    <img class="img-fluid" src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="max-height: 500px; object-fit: contain;">
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="s_product_text">
                    <h3>{{ $product->name }}</h3>
                    <h2>{{ number_format($product->price, 2) }} RSD</h2>
                    <ul class="list">
                        <li><a class="active" href="#"><span>Kategorija</span> : {{ $product->category->name }}</a></li>
                        <li><a href="#"><span>Dostupnost</span> : Na stanju</a></li>
                    </ul>
                    <p class="mt-4">{{ $product->description }}</p>

                    <div class="product_count">
                        <label for="qty">Količina:</label>
                        <input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
                        <button class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                        <button class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                    </div>

                    <div class="card_area d-flex align-items-center mt-4">
                        <a class="primary-btn add-to-cart-btn" href="{{ route('cart.add', $product->id) }}" data-id="{{ $product->id }}">Dodaj u korpu</a>
                        <a class="icon_btn" href="#"><i class="lnr lnr lnr-heart"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="related-product-area section_gap_bottom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h1>Slični modeli</h1>
                    <p>Pogledajte i ostale modele iz kategorije {{ $product->category->name }}.</p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($relatedProducts as $related)
            <div class="col-lg-3 col-md-6">
                <div class="single-product">
                    <img class="img-fluid" src="{{ asset($related->image) }}" alt="">
                    <div class="product-details text-center">
                        <h6>{{ $related->name }}</h6>
                        <div class="price">
                            <h6>{{ number_format($related->price, 2) }} RSD</h6>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {

            $(document).on('click', '.add-to-cart-btn', function(e) {
                e.preventDefault();

                let productId = $(this).data('id');

                $.ajax({
                    url: '/add-to-cart/' + productId,
                    type: 'GET',
                    success: function(response) {
                        if(response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Uspešno!',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            });

                            $('.nav-shop__circle').text(response.cartCount);
                        }
                    },
                    error: function(xhr) {
                        console.error("Greška AJAX korpe:", xhr);
                        Swal.fire({
                            icon: 'error',
                            title: 'Greška',
                            text: 'Došlo je do greške prilikom dodavanja u korpu.',
                            showConfirmButton: true
                        });
                    }
                });
            });

        });
    </script>
@endsection
