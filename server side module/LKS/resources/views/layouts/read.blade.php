@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col">
        @if (@session('status'))
        <div class="alert alert-success" role="alert">
                {{@session('status')}}
              </div>
        @endif
            @section('link-tambah')
            @show
    </div>
</div>
<div class="row justify-content-center">
    @section('tabel')
    @show
</div>
@endsection