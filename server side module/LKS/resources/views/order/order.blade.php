@extends('layouts.read')
@section('link-tambah')
<a href="order/create" class="btn btn-success my-3">tambah order</a>
@endsection

@section('tabel')
<table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">no</th>
        <th scope="col">nama kontak</th>
        <th scope="col">nomer kontak</th>
        <th scope="col">plat nomer</th>
        <th scope="col">nama driver</th>
        <th scope="col">tanggal mulai</th>
        <th scope="col">jumlah hari</th>
        <th scope="col">pilihan</th>
      </tr>
    </thead>
    <tbody>
        @foreach($order as $o)
      <tr>
      <th scope="row">{{$loop->iteration}}</th>
      <td>{{$o[0]->contact_name}}</td>
      <td>{{$o[0]->contact_phone}}</td>
      <td>{{$o[1]->plat_number}}</td>
      <td>{{$o[2]->name}}</td>
      <td>{{$o[0]->start_rent_date}}</td>
      <td>{{$o[0]->total_rent_days}}</td>
      <td>
      <a href="/order/{{$o[0]->id}}/edit" class="btn btn-primary">ubah</a>
      <form action="{{url('order/'.$o[0]->id)}}" method="post" class="d-inline-block">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">hapus</button>
        </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endsection