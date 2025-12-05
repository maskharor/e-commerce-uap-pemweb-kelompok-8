@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Manajemen User</h2>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Peran</th>
                <th>Tanggal Gabung</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $usr)
            <tr>
                <td>{{ $usr->name }}</td>
                <td>{{ $usr->email }}</td>
                <td>{{ $usr->role }}</td>
                <td>{{ $usr->created_at->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
