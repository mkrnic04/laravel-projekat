<div class="row">
    @if($products->count() > 0)
        @foreach($products as $product)
            <div class="col-lg-4 col-md-6">
                <div class="single-product">
                    <a href="{{ route('shop.show', $product->id) }}">
                        <img class="img-fluid" src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="width: 100%; height: 250px; object-fit: contain;">
                    </a>
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
                                <p class="hover-text">detalji</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="col-12 text-center mt-5">
            <h4 class="text-muted">Nema pronađenih patika za ove filtere.</h4>
        </div>
    @endif
</div>

<div class="filter-bar d-flex flex-wrap align-items-center justify-content-center mt-4">
    <div class="pagination-custom-wrapper">
        {{ $products->appends(request()->input())->links() }}
    </div>
</div>