@extends('layouts.main')
@section('title','tambah bus')
@section('content')
<div class="form">
    <form action="/bus" method="POST">
        @csrf
        <div class="form-title">
                <h1>Tambah bus</h1>
            </div>
        <div class="input">
            <label for="plat">plat:</label>
        <input type="text" name="plat_number" id="plat" value="{{old('plat_number')}}">
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
        <input type="number" name="seat" id="seat" value="{{old('seat')}}">
        @error('seat')
        <p class="error">jumlah kursi harus di isi dan minimal 11</p> 
        @enderror
        </div>
        <div class="input">
            <label for="price">price : </label>
        <input type="number" name="price" id="price" value="{{old('price')}}">
            @error('price')
            <p class="error">harga harus di isi dan minimal 100K</p>
            @enderror
        </div>
        <button type="submit">tambah</button>
    </form>
</div>
@endsection