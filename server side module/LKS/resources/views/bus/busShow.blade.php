@extends('layouts.app')
@section('content')
    <div class="row min-vh-100">
        <div class="col">
            <div class="card mb-3" >
            <div class="row no-gutters">
                <div class="col-md-6">
                <img src="{{ asset($bus[0]->bus_img) }}" class="card-img h-100" alt="...">
                </div>
                <div class="col-md-6">
                <div class="card-body">
                <h5 class="card-title display-4">{{$bus[0]->plat_number}}</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text">Brand : {{ $bus[0]->brand }}</p>
                    <p class="card-text">Jumlah kursi : {{ $bus[0]->seat }}</p>
                    <p class="card-text">Biaya sewa per hari : {{ $bus[0]->price_per_day }}</p>
                    <p class="card-text">Status order : {{ $order }}</p>
                <p class="card-text"><small class="text-muted">Terdaftar atau diperbarui pada : {{$bus[0]->updated_at}}</small></p>
                <a href="{{url('bus')}}" class="btn alert-warning">kembali</a>
                <a href="{{url('bus/'.$bus[0]->id).'/edit'}}" class="btn btn-primary">ubah bis</a>
                <a href="{{url('order/create')}}" class="btn btn-success">order</a>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection