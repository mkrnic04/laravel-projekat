@extends('layouts.app')

@section('content')
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Kontaktirajte nas</h1>
            </div>
        </div>
    </div>
</section>

<section class="contact_area section_gap mt-5 mb-5">
    <div class="container">
        <div class="row bg-white shadow-lg p-5 rounded">

            <div class="col-lg-4 mb-5 mb-lg-0">
                <div class="contact_info text-left">
                    <div class="info_item mb-4">
                        <i class="lnr lnr-home" style="font-size: 28px; color: #ffba00;"></i>
                        <h5 class="mt-3">Beograd, Srbija</h5>
                        <p class="text-muted">Knez Mihailova 1</p>
                    </div>
                    <div class="info_item mb-4">
                        <i class="lnr lnr-phone-handset" style="font-size: 28px; color: #ffba00;"></i>
                        <h5 class="mt-3"><a href="#" class="text-dark">+381 60 123 4567</a></h5>
                        <p class="text-muted">Radno vreme: 09-17h</p>
                    </div>
                    <div class="info_item">
                        <i class="lnr lnr-envelope" style="font-size: 28px; color: #ffba00;"></i>
                        <h5 class="mt-3"><a href="#" class="text-dark">admin@patikeshop.com</a></h5>
                        <p class="text-muted">Pošaljite nam upit bilo kada!</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                @if(session('success'))
                    <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 20px; font-size: 16px; border-radius: 8px; margin-bottom: 25px;">
                        <i class="fa fa-check-circle mr-2"></i> {{ session('success') }}
                    </div>
                @endif

                <form class="row contact_form" action="{{ route('contact.send') }}" method="POST">
                    @csrf

                    <div class="col-md-12">
                        <div class="form-group mb-4">
                            <input type="text" class="form-control custom-input" name="name" placeholder="Unesite vaše ime" value="{{ old('name') }}" required>
                            @error('name') <small class="text-danger font-weight-bold">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group mb-4">
                            <input type="email" class="form-control custom-input" name="email" placeholder="Unesite email adresu" value="{{ old('email') }}" required>
                            @error('email') <small class="text-danger font-weight-bold">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group mb-4">
                            <input type="text" class="form-control custom-input" name="subject" placeholder="Naslov poruke" value="{{ old('subject') }}" required>
                            @error('subject') <small class="text-danger font-weight-bold">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group mb-4">
                            <textarea class="form-control custom-input" name="message" rows="7" placeholder="Napišite vašu poruku ovde..." required>{{ old('message') }}</textarea>
                            @error('message') <small class="text-danger font-weight-bold">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-12 mt-3">
                        <button type="submit" value="submit" class="primary-btn text-uppercase font-weight-bold" style="width: 100%; padding: 15px; font-size: 16px; letter-spacing: 1px; border-radius: 8px;">
                            Pošalji poruku
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
    .custom-input {
        height: 60px;
        font-size: 16px;
        border-radius: 8px;
        padding: 10px 25px;
        border: 1px solid #e5e5e5;
        background-color: #fafafa;
        transition: all 0.3s ease;
    }
    .custom-input:focus {
        border-color: #ffba00;
        box-shadow: 0 0 8px rgba(255, 186, 0, 0.3);
        background-color: #fff;
    }
    textarea.custom-input {
        height: auto;
        padding-top: 20px;
    }
    .contact_info h5 {
        font-size: 20px;
        font-weight: 600;
    }
    .info_item {
        padding: 25px;
        background: #fdfdfd;
        border-radius: 12px;
        border: 1px solid #f2f2f2;
        transition: all 0.3s ease;
    }
    .info_item:hover {
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        transform: translateY(-5px);
        border-color: #ffba00;
    }
    .contact_form .form-control {
        box-shadow: none !important;
    }
</style>
@endsection
