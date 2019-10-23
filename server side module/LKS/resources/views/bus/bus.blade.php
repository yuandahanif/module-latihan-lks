@extends('layouts.read')
@section('link-tambah')
    <a href="bus/create" class="btn btn-success my-3">tambah bis</a>
@endsection
@section('tabel')
    @foreach ($bus as $s)
    <div class="col-4 my-3">
    <div class="card">
            <div class="card-body">
            <h5 class="card-title">{{$s->plat_number}}</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
            <ul class="list-group list-group-flush">
            <li class="list-group-item">Brand : {{$s->brand}}</li>
            <li class="list-group-item">Tempat duduk : {{$s->seat}}</li>
            <li class="list-group-item">Harga per hari : {{$s->price_per_day}}</li>
            </ul>
            <div class="card-body justify-content-center">
                <a href="/bus/{{$s->id}}" class="btn btn-primary">Detail bis</a>
                <a href="/bus/{{$s->id}}/edit" class="btn btn-success">Ubah bis</a>
                <form action="/bus/{{$s->id}}" method="post" class=" d-inline-block">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger">Hapus bis</button>
                </form>
            </div>
            </div>
        </div>
    @endforeach
@endsection