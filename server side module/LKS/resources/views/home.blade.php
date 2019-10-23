@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">Naviagtion menu</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row ">
                        <div class="col">
                            <div class="card">
                            <div class="card-body">
                                <h1 class="card-title">Menu Bus</h1>
                                <h6 class="card-subtitle mb-2 text-muted">Lihat,Edit,Tambah atau Hapus daftar bus</h6>
                                <a href="bus" class="card-link">Lihat</a>
                            </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                            <div class="card-body">
                                <h1 class="card-title">Menu Driver</h1>
                                <h6 class="card-subtitle mb-2 text-muted">Lihat,Edit,Tambah atau Hapus daftar pengemudi</h6>
                                <a href="driver" class="card-link">Lihat</a>
                            </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                            <div class="card-body">
                                <h1 class="card-title">Menu Order</h1>
                                <h6 class="card-subtitle mb-2 text-muted">Lihat,Edit,Tambah atau Hapus order</h6>
                                <a href="order" class="card-link">Lihat</a>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
