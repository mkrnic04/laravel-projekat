@extends('adminlte::page')

@section('title', 'Admin Panel')

@section('content_header')
    <h1>Dobrodošli na admin panel</h1>
    <p>Možete pristupiti funkcionalnostima iz menija sa strane</p>
    <p>Klikom na "Admin nalog" u gornjem desnom uglu se možete izlogovati</p>
@stop

@section('css')
    @stop

@section('js')
    <script> console.log('Admin panel učitan!'); </script>
@stop
