@extends('layouts.app')
@section('name')
    Halaman Dashboard
@endsection

@section('content')
<div class="alert alert-info alert-dismissible">
    <div class="row">
        <div class="col-md-8">
            <h3><i class="icon fas fa-info"></i> Selamat Datang di SI Stock Management</h3>
            <h6>Saat ini anda login sebagai {{ Auth::user()->name }} dengan level {{ auth::user()->role }}</h6>
        </div>
        <div class="col-md-4 d-flex justify-content-end">
            <i class="fas fa-calendar-alt mr-1"></i> <h6>{{ \carbon\Carbon::now()->format('d-m-Y') }}</h6>
        </div>
    </div>
  </div>
@endsection
