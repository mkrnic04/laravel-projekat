@extends('adminlte::page')

@section('title', 'Dnevnik aktivnosti')

@section('content_header')
    <h1>Dnevnik aktivnosti sistema</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Pretraga po datumu</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.activities.index') }}" method="GET" class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Od datuma:</label>
                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Do datuma:</label>
                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}" required>
                </div>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <div class="form-group w-100">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Filtriraj</button>
                    <a href="{{ route('admin.activities.index') }}" class="btn btn-secondary">Poništi</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card mt-3">
    <div class="card-body p-0 table-responsive">
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Vreme</th>
                    <th>Korisnik</th>
                    <th>Akcija</th>
                    <th>Detalji</th>
                    <th>IP Adresa</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                <tr>
                    <td>{{ $log->created_at->format('d.m.Y H:i:s') }}</td>
                    <td>
                        @if($log->user)
                            <span class="badge badge-info">{{ $log->user->name }}</span>
                        @else
                            <span class="badge badge-secondary">Gost</span>
                        @endif
                    </td>
                    <td><strong>{{ $log->action }}</strong></td>
                    <td>{{ $log->description }}</td>
                    <td>{{ $log->ip_address }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Nema zabeleženih aktivnosti za ovaj period.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix">
        {{ $logs->appends(request()->query())->links() }}
    </div>
</div>
@stop