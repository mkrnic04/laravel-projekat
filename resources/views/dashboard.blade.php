@extends('layouts.app')

@section('content')
    <div class="container mt-5 mb-5 text-center">
        <h1>Zdravo, {{ Auth::user()->name }}!</h1>
        <p>Uspešno ste se ulogovali. Dobrodošli u Patike Shop.</p>
        <a href="{{ route('home') }}" class="primary-btn">Vrati se na početnu</a>
    </div>
@endsection
