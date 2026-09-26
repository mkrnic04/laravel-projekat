@extends('layouts.app')

@section('title', 'Početna')

@section('content')
    <section class="banner-area">
        <div class="container">
            <div class="row fullscreen align-items-center justify-content-start">
                <div class="col-lg-12">
                    <div class="active-banner-slider owl-carousel">
                        <div class="row single-slide align-items-center d-flex">
                            <div class="col-lg-5 col-md-6">
                                <div class="banner-content">
                                    <h1>Nova Nike <br>Kolekcija!</h1>
                                    <p>Otkrijte najnovije trendove i vrhunski kvalitet. Naša nova kolekcija donosi savršen spoj udobnosti i stila za svaku priliku.</p>
                                    <div class="add-bag d-flex align-items-center">
                                        <a class="add-btn" href="{{ route('shop.index') }}"><span class="lnr lnr-arrow-right"></span></a>
                                        <span class="add-text text-uppercase">Posetite Shop</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="banner-img">
                                    <img class="img-fluid" src="{{ asset('img/banner/banner-img.png') }}" alt="Banner slika">
                                </div>
                            </div>
                        </div>
                        <div class="row single-slide align-items-center d-flex">
                            <div class="col-lg-5 col-md-6">
                                <div class="banner-content">
                                    <h1>Prolećni <br>Popusti!</h1>
                                    <p>Iskoristite sjajne popuste na odabrane artikle iz prošle sezone. Vaš omiljeni brend nikad nije bio pristupačniji.</p>
                                    <div class="add-bag d-flex align-items-center">
                                        <a class="add-btn" href="{{ route('shop.index') }}"><span class="lnr lnr-arrow-right"></span></a>
                                        <span class="add-text text-uppercase">Vidi Ponudu</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="banner-img">
                                    <img class="img-fluid" src="{{ asset('img/banner/banner-img.png') }}" alt="Banner slika 2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="features-area section_gap">
        <div class="container">
            <div class="row features-inner">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-features">
                        <div class="f-icon">
                            <img src="{{ asset('img/features/f-icon1.png') }}" alt="Besplatna dostava">
                        </div>
                        <h6>Besplatna Dostava</h6>
                        <p>Za sve porudžbine</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-features">
                        <div class="f-icon">
                            <img src="{{ asset('img/features/f-icon2.png') }}" alt="Povrat novca">
                        </div>
                        <h6>Politika Povrata</h6>
                        <p>Povrat novca u roku od 30 dana</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-features">
                        <div class="f-icon">
                            <img src="{{ asset('img/features/f-icon3.png') }}" alt="Podrška">
                        </div>
                        <h6>24/7 Podrška</h6>
                        <p>Uvek smo tu za vas</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-features">
                        <div class="f-icon">
                            <img src="{{ asset('img/features/f-icon4.png') }}" alt="Sigurno plaćanje">
                        </div>
                        <h6>Sigurno Plaćanje</h6>
                        <p>Vaši podaci su zaštićeni</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="category-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-12">
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="single-deal">
                                <div class="overlay"></div>
                                <img class="img-fluid w-100" src="{{ asset('img/category/c1.jpg') }}" alt="Kategorija 1">
                                <a href="{{ asset('img/category/c1.jpg') }}" class="img-pop-up" target="_blank">
                                    <div class="deal-details">
                                        <h6 class="deal-title">Patike za trčanje</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="single-deal">
                                <div class="overlay"></div>
                                <img class="img-fluid w-100" src="{{ asset('img/category/c2.jpg') }}" alt="Kategorija 2">
                                <a href="{{ asset('img/category/c2.jpg') }}" class="img-pop-up" target="_blank">
                                    <div class="deal-details">
                                        <h6 class="deal-title">Zimska kolekcija</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="single-deal">
                                <div class="overlay"></div>
                                <img class="img-fluid w-100" src="{{ asset('img/category/c3.jpg') }}" alt="Kategorija 3">
                                <a href="{{ asset('img/category/c3.jpg') }}" class="img-pop-up" target="_blank">
                                    <div class="deal-details">
                                        <h6 class="deal-title">Sportska oprema</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="single-deal">
                                <div class="overlay"></div>
                                <img class="img-fluid w-100" src="{{ asset('img/category/c4.jpg') }}" alt="Kategorija 4">
                                <a href="{{ asset('img/category/c4.jpg') }}" class="img-pop-up" target="_blank">
                                    <div class="deal-details">
                                        <h6 class="deal-title">Lifestyle</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-deal">
                        <div class="overlay"></div>
                        <img class="img-fluid w-100" src="{{ asset('img/category/c5.jpg') }}" alt="Kategorija 5">
                        <a href="{{ asset('img/category/c5.jpg') }}" class="img-pop-up" target="_blank">
                            <div class="deal-details">
                                <h6 class="deal-title">Aksesoari</h6>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section_gap">
        <div class="single-product-slider">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <div class="section-title">
                            <h1>Najnoviji Proizvodi</h1>
                            <p>Ovi proizvodi se sada dinamički učitavaju direktno iz tvoje baze podataka.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @forelse($latestProducts as $product)
                        <div class="col-lg-3 col-md-6">
                            <div class="single-product">
                                <img class="img-fluid" src="{{ $product->image }}">
                                <div class="product-details">
                                    <h6>{{ $product->name }}</h6>
                                    <div class="price">
                                        <h6>{{ number_format($product->price, 2) }} RSD</h6>
                                    </div>
                                    <div class="prd-bottom">
                                        <a href="{{ route('cart.add', $product->id) }}" class="social-info add-to-cart-btn" data-id="{{ $product->id }}">
                                            <span class="ti-bag"></span>
                                            <p class="hover-text">u korpu</p>
                                        </a>
                                        <a href="{{ route('shop.show', $product->id) }}" class="social-info">
                                            <span class="lnr lnr-move"></span>
                                            <p class="hover-text">vidi više</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <h4>Nema proizvoda u bazi. Pokrenite seeder!</h4>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
    <section class="brand-area section_gap">
        <div class="container">
            <div class="row">
                <a class="col single-img" href="#">
                    <img class="img-fluid d-block mx-auto" src="{{ asset('img/brand/1.png') }}" alt="Brend 1">
                </a>
                <a class="col single-img" href="#">
                    <img class="img-fluid d-block mx-auto" src="{{ asset('img/brand/2.png') }}" alt="Brend 2">
                </a>
                <a class="col single-img" href="#">
                    <img class="img-fluid d-block mx-auto" src="{{ asset('img/brand/3.png') }}" alt="Brend 3">
                </a>
                <a class="col single-img" href="#">
                    <img class="img-fluid d-block mx-auto" src="{{ asset('img/brand/4.png') }}" alt="Brend 4">
                </a>
                <a class="col single-img" href="#">
                    <img class="img-fluid d-block mx-auto" src="{{ asset('img/brand/5.png') }}" alt="Brend 5">
                </a>
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
