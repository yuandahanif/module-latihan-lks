@extends('layouts.main')
@section('title','edit bus')
{{-- @dd($bus) --}}
@section('content')
<div class="form">
        <form action="/bus/{{$bus[0]->id}}" method="POST">
            @csrf
            @method('put')
            <div class="form-title">
                    <h1>Tambah bus</h1>
                </div>
            <div class="input">
                <label for="plat">plat:</label>
            <input type="text" name="plat_number" id="plat" value="{{$bus[0]->plat_number}}">
                @error('plat_number')
                    <p class="error">plat nomer harus di isi</p>
                @enderror
            </div>
            <div class="input">
                <label for="brand">brand</label>
                <select name="brand" id="brand">
                    <option value="merchedes">merchedes</option>
                    <option value="fuso">fuso</option>
                    <option value="scnia">scania</option>
                </select>
            </div>
            <div class="input">
                <label for="seat">seat : </label>
            <input type="number" name="seat" id="seat" value="{{$bus[0]->seat}}">
            @error('seat')
            <p class="error">jumlah kursi harus di isi dan minimal 11</p> 
            @enderror
            </div>
            <div class="input">
                <label for="price">price : </label>
            <input type="number" name="price" id="price" value="{{$bus[0]->price_per_day}}">
                @error('price')
                <p class="error">harga harus di isi dan minimal 100K</p>
                @enderror
            </div>
            <button type="submit">edit</button>
        </form>
    </div>
@endsection