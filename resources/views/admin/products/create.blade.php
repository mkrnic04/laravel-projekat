@extends('adminlte::page')

@section('title', 'Dodaj nove patike')

@section('content_header')
    <h1>Dodaj nove patike</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label>Naziv modela</label>
                <input type="text" name="name" class="form-control" placeholder="npr. Nike Air Max" required>
            </div>

            <div class="form-group">
                <label>Kategorija</label>
                <select name="category_id" class="form-control" required>
                    <option value="">Izaberi kategoriju</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Cena (RSD)</label>
                <input type="number" name="price" class="form-control" placeholder="9999.00" required>
            </div>

            <div class="form-group">
                <label>Opis</label>
                <textarea name="description" class="form-control" rows="3" placeholder="Unesite kratak opis patika..."></textarea>
            </div>

            <div class="form-group">
                <label>Slika patika</label>
                <input type="file" name="image" class="form-control-file" required>
            </div>

            <button type="submit" class="btn btn-success">Sačuvaj u bazu</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Odustani</a>
        </form>
    </div>
</div>
@stop