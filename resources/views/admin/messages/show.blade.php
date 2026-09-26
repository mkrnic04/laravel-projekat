@extends('adminlte::page')

@section('title', 'Detalji poruke')

@section('content_header')
    <h1>Detalji poruke</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header bg-primary">
        <h3 class="card-title">Tema: {{ $message->subject }}</h3>
    </div>
    <div class="card-body">
        <p><strong>Od:</strong> {{ $message->name }} ( <a href="mailto:{{ $message->email }}">{{ $message->email }}</a> )</p>
        <p><strong>Poslato:</strong> {{ $message->created_at->format('d.m.Y H:i') }}</p>
        <hr>
        <h5>Sadržaj poruke:</h5>
        <div class="p-3 mb-2 bg-light text-dark rounded border">
            {!! nl2br(e($message->message)) !!}
        </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Nazad na listu
        </a>
        <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" class="btn btn-success float-right">
            <i class="fas fa-reply"></i> Odgovori putem maila
        </a>
    </div>
</div>
@stop