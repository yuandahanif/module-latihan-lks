@extends('layouts.read')

@section('link-tambah')
<a href="driver/create" class="btn btn-success my-3">tambah driver</a>
@endsection
@section('tabel')
    @foreach ($driver as $d)
    <div class="col-4 my-3">
        <div class="card">
                <div class="card-body">
                <h5 class="card-title">{{$d->name}}</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <ul class="list-group list-group-flush">
                <li class="list-group-item">usia : {{$d->age}}</li>
                <li class="list-group-item">id driver : {{$d->id_numbers}}</li>
                <li class="list-group-item">bis : maaf belum tersedia</li>
                </ul>
                <div class="card-body justify-content-center">
                    <a href="/driver/{{$d->id}}" class="btn btn-primary my-1">Detail driver</a>
                    <a href="/driver/{{$d->id}}/edit" class="btn btn-success">Ubah driver</a>
                    <form action="/driver/{{$d->id}}" method="post" class=" d-inline-block">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger">Hapus driver</button>
                    </form>
                </div>
                </div>
            </div>
    @endforeach
@endsection