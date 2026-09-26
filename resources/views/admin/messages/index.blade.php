@extends('adminlte::page')

@section('title', 'Poruke')

@section('content_header')
    <h1>Primljene poruke</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Status</th>
                    <th>Pošiljalac</th>
                    <th>Naslov</th>
                    <th>Datum</th>
                    <th>Akcija</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $msg)
                <tr style="{{ $msg->is_read ? '' : 'font-weight: bold; background-color: #f4f6f9;' }}">
                    <td>
                        @if($msg->is_read)
                            <span class="badge badge-success">Pročitano</span>
                        @else
                            <span class="badge badge-danger">Novo</span>
                        @endif
                    </td>
                    <td>{{ $msg->name }} ({{ $msg->email }})</td>
                    <td>{{ $msg->subject }}</td>
                    <td>{{ $msg->created_at->format('d.m.Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.messages.show', $msg->id) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i> Otvori
                        </a>
                        <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Obriši poruku?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop