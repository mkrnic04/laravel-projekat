@extends('layouts.app')

@section('content')
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Vaša Korpa</h1>
            </div>
        </div>
    </div>
</section>

<section class="cart_area mt-5">
    <div class="container">
        <div class="cart_inner">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Proizvod</th>
                            <th scope="col">Cena</th>
                            <th scope="col">Količina</th>
                            <th scope="col">Ukupno</th>
                            <th scope="col">Akcija</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0 @endphp
                        @if(session('cart') && count(session('cart')) > 0)
                            @foreach(session('cart') as $id => $details)
                                @php $total += $details['price'] * $details['quantity'] @endphp
                                <tr data-id="{{ $id }}">
                                    <td>
                                        <div class="media">
                                            <div class="d-flex">
                                                <img src="{{ asset($details['image']) }}" alt="" style="width: 100px;">
                                            </div>
                                            <div class="media-body">
                                                <p>{{ $details['name'] }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td><h5>{{ number_format($details['price'], 2) }} RSD</h5></td>

                                    <td>
                                        <div class="product_count">
                                            <input type="text" name="qty" id="sst{{ $id }}" maxlength="12" value="{{ $details['quantity'] }}" title="Quantity:" class="input-text qty" data-id="{{ $id }}" readonly>
                                            <button class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                                            <button class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                                        </div>
                                    </td>

                                    <td><h5 id="subtotal-{{ $id }}">{{ number_format($details['price'] * $details['quantity'], 2) }} RSD</h5></td>

                                    <td>
                                        <button class="btn btn-danger btn-sm remove-from-cart-btn" data-id="{{ $id }}">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach

                            <tr class="bottom_button">
                                <td colspan="3"></td>
                                <td><h5>Ukupno:</h5></td>
                                <td><h5 id="cart-total">{{ number_format($total, 2) }} RSD</h5></td>
                            </tr>

                            <tr class="out_button_area">
                                <td colspan="3"></td>
                                <td colspan="2">
                                    <div class="checkout_btn_inner d-flex align-items-center">
                                        <a class="gray_btn" href="{{ route('shop.index') }}">Nastavi kupovinu</a>
                                        <a class="primary-btn" href="{{ route('checkout') }}">Završi kupovinu</a>
                                    </div>
                                </td>
                            </tr>
                        @else
                            <tr id="empty-cart-message">
                                <td colspan="5" class="text-center"><h4>Vaša korpa je prazna.</h4></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {

    $(document).on('click', '.increase, .reduced', function() {
        let isIncrease = $(this).hasClass('increase');
        let input = $(this).siblings('.qty');
        let currentVal = parseInt(input.val());
        let id = input.data('id');

        if (!isNaN(currentVal)) {
            let newVal = isIncrease ? currentVal + 1 : currentVal - 1;

            if (newVal >= 1) {
                input.val(newVal);

                $.ajax({
                    url: '{{ route("cart.update") }}',
                    method: "PATCH",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        quantity: newVal
                    },
                    success: function (response) {
                        if(response.success) {
                            $('#subtotal-' + id).text(response.subTotal);
                            $('#cart-total').text(response.total);
                        }
                    }
                });
            }
        }
    });

    $(document).on('click', '.remove-from-cart-btn', function(e) {
        e.preventDefault();
        let id = $(this).data("id");
        let row = $(this).closest("tr");

        Swal.fire({
            title: 'Izbaci iz korpe?',
            text: "Da li ste sigurni da želite da uklonite ovaj proizvod?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Da, ukloni!',
            cancelButtonText: 'Odustani'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("cart.remove") }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id
                    },
                    success: function (response) {
                        if(response.success) {
                            row.fadeOut(400, function() {
                                $(this).remove();
                                if($('tbody tr[data-id]').length === 0) {
                                    location.reload();
                                }
                            });

                            $('.nav-shop__circle').text(response.cartCount);
                            $('#cart-total').text(response.total);

                            Swal.fire({
                                icon: 'success',
                                title: 'Uklonjeno!',
                                showConfirmButton: false,
                                timer: 1000
                            });
                        }
                    }
                });
            }
        });
    });

});
</script>
@endsection
