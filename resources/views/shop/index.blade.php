@extends('layouts.app')

@section('title', 'Shop')

@section('content')
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Premium Patike</h1>
            </div>
        </div>
    </div>
</section>

<div class="container mt-5">
    <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-5">
            <div class="sidebar-categories shadow-sm p-3 mb-5 bg-white rounded">
                <div class="head" style="background: #222;">Kategorije</div>
                <ul class="main-categories mt-3">
                    <li class="main-nav-list">
                        <a href="{{ route('shop.index') }}"
                        class="ajax-link {{ !request()->filled('category') ? 'active-cat' : '' }}">
                            Sve patike
                        </a>
                    </li>
                    @foreach($categories as $category)
                        <li class="main-nav-list">
                            <a href="{{ route('shop.index', ['category' => $category->id]) }}"
                            class="ajax-link {{ request('category') == $category->id ? 'active-cat' : '' }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="text-center mt-4">
                    <a href="{{ route('shop.index') }}" class="btn-reset-all">
                        <i class="fa fa-refresh"></i> Poništi sve filtere
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-lg-8 col-md-7">
            <div class="filter-bar d-flex flex-wrap align-items-center shadow-sm">
                <div class="sorting mr-auto">
                    <select id="sort-select" class="custom-select-shop">
                        <option value="">Sortiraj po...</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Cena: Niža ka višoj</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Cena: Viša ka nižoj</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Naziv: A-Z</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Naziv: Z-A</option>
                    </select>
                </div>

                <div class="sorting">
                    <form id="search-form" class="d-flex align-items-center">
                        <input type="text" name="search" id="search-input" class="form-control shop-search-input"
                               placeholder="Pretraži modele..." value="{{ request('search') }}">
                        @if(request('search') || request('category') || request('sort'))
                             <a href="{{ route('shop.index') }}" class="clear-search" title="Poništi pretragu">&times;</a>
                        @endif
                    </form>
                </div>
            </div>

            <section class="lattest-product-area pb-40 category-list mt-4">
                <div id="product-data">
                    @include('shop.partials.product_list')
                </div>
            </section>
        </div>
    </div>
</div>

<style>
    .active-cat { color: #ffba00 !important; font-weight: 700 !important; }
    .sidebar-categories .head { border-radius: 5px 5px 0 0; }
    .btn-reset-all { display: inline-block; padding: 8px 15px; background: #f4f4f4; color: #222; border-radius: 20px; font-size: 13px; transition: 0.3s; border: 1px solid #ddd; }
    .btn-reset-all:hover { background: #ffba00; color: white; border-color: #ffba00; }
    .custom-select-shop { height: 35px; border: 1px solid #eee; border-radius: 20px; padding: 0 15px; font-size: 13px; color: #777; outline: none; }
    .shop-search-input { height: 35px; border-radius: 20px !important; border: 1px solid #eee !important; padding-right: 30px; font-size: 13px; }
    .clear-search { margin-left: -25px; z-index: 5; color: #999; font-size: 18px; font-weight: bold; text-decoration: none !important; }
    #product-data { transition: opacity 0.3s ease; }
    .filter-bar { background: #f9f9f9; padding: 10px 20px; border-radius: 5px; }
    .single-product { border: 1px solid #f2f2f2; padding: 15px; border-radius: 10px; transition: 0.3s; background: #fff; }
    .single-product:hover { box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important; border-color: #ffba00; transform: translateY(-10px); }
    .single-product img { transition: transform 0.5s ease; }
    .single-product:hover img { transform: scale(1.1); }
    .pagination-custom-wrapper { display: flex; align-items: center; justify-content: center; width: 100%; }
    .pagination-custom-wrapper nav div:first-child { display: none !important; }
    .pagination-custom-wrapper .pagination { margin: 0 !important; padding: 0 !important; display: flex !important; flex-direction: row !important; align-items: center; list-style: none; }
    .pagination-custom-wrapper .page-item .page-link { width: 35px !important; height: 35px !important; border-radius: 50% !important; margin: 0 3px !important; display: flex !important; align-items: center !important; justify-content: center !important; font-size: 13px; border: 1px solid #eee; color: #222; background: #fff; padding: 0 !important; }
    .pagination-custom-wrapper .page-item.active .page-link { background: #ffba00 !important; border-color: #ffba00 !important; color: #fff !important; box-shadow: 0 3px 8px rgba(255, 186, 0, 0.2); }
    .pagination-custom-wrapper svg { width: 16px !important; height: 16px !important; }
    .sidebar-categories .main-nav-list a { padding: 12px 20px; border-bottom: 1px solid #f9f9f9; display: flex; justify-content: space-between; transition: 0.3s; }
    .sidebar-categories .main-nav-list a:hover { padding-left: 30px; background: #fffaf0; }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {

    function getFilters() {
        return {
            category: new URLSearchParams(window.location.search).get('category') || '',
            search: $('#search-input').val(),
            sort: $('#sort-select').val(),
            page: new URLSearchParams(window.location.search).get('page') || 1
        };
    }

    function updateProducts(url) {
        $.ajax({
            url: url,
            type: 'GET',
            beforeSend: function() {
                $('#product-data').css('opacity', '0.5');
            },
            success: function(data) {
                $('#product-data').html(data);
                $('#product-data').css('opacity', '1');
                window.history.pushState({}, '', url);
            },
            error: function() {
                console.log("Greška prilikom učitavanja proizvoda.");
            }
        });
    }

    $(document).on('change', '#sort-select', function() {
        let filters = getFilters();
        let url = "{{ route('shop.index') }}?sort=" + $(this).val() + "&category=" + filters.category + "&search=" + filters.search;
        updateProducts(url);
    });

    let typingTimer;
    $(document).on('keyup', '#search-input', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(() => {
            let filters = getFilters();
            let url = "{{ route('shop.index') }}?search=" + $(this).val() + "&category=" + filters.category + "&sort=" + filters.sort;
            updateProducts(url);
        }, 500);
    });

    $(document).on('click', '.ajax-link, .pagination a', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');

        if ($(this).hasClass('ajax-link')) {
            $('.main-categories a').removeClass('active-cat');
            $(this).addClass('active-cat');
        }
        updateProducts(url);
    });

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
