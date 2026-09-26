@extends('adminlte::page')

@section('title', 'Lista patika')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Upravljanje patikama</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Dodaj nove patike</a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Slika</th>
                        <th>Naziv</th>
                        <th>Kategorija</th>
                        <th>Cena</th>
                        <th>Akcije</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td><img src="{{ asset($product->image) }}" width="50"></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? 'Nema' }}</td>
                        <td>{{ number_format($product->price, 2) }} RSD</td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-info">Izmeni</a>
                            <button class="btn btn-danger btn-sm delete-product-btn" data-id="{{ $product->id }}">
                                <i class="fas fa-trash"></i> Obriši
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.delete-product-btn', function(e) {
        e.preventDefault();

        let id = $(this).data("id");
        let row = $(this).closest("tr");

        Swal.fire({
            title: 'Da li ste sigurni?',
            text: "Ovaj proizvod će biti trajno obrisan iz baze!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Da, obriši!',
            cancelButtonText: 'Odustani'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: '/admin/products/' + id,
                    method: "DELETE",
                    success: function (response) {
                        if(response.success) {

                            row.fadeOut(400, function() {
                                $(this).remove();
                            });

                            Swal.fire({
                                icon: 'success',
                                title: 'Obrisano!',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Greška!',
                            text: 'Nešto nije u redu sa serverom.'
                        });
                    }
                });
            }
        });
    });

});
</script>
@stop
