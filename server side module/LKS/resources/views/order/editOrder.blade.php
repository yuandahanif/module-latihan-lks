@extends('layouts.main')
@section('title','edit order')
@section('content')
<div class="form">
<form action="/order/{{$order->id}}" method="POST">
        @csrf
        @method('put')
        <div class="form-title">
                <h1>edit order</h1>
            </div>
        <div class="input">
            <label for="bus">bus : </label>
            <select name="bus" id="bus">
                @foreach($bus as $b)
            <option value="{{$b->id}}">{{$b->brand}} | kursi:{{$b->seat}} | harga:{{$b->price_per_day}}</option>
                @endforeach
            </select>
        </div>
        <div class="input">
                <label for="driver">driver : </label>
                <select name="driver" id="driver">
                    @foreach($driver as $d)
                <option value="{{$d->id}}">{{$d->name}} | usia:{{$d->age}}</option>
                    @endforeach
                </select>
            </div>
        <div class="input">
            <label for="contact_name">nama kontak : </label>
        <input type="text" name="contact_name" id="contact_name" value="{{$order->contact_name}}">
        @error('contact_name')
        <p class="error">nama kontak harus di isi dan minimal 18</p> 
        @enderror
        </div>
        <div class="input">
            <label for="contact_phone">nomer kontak : </label>
        <input type="number" name="contact_phone" id="contact_phone" value="{{$order->contact_phone}}">
            @error('contact_phone')
            <p class="error">namer kontak harus di isi dan minimal 16 huruf</p>
            @enderror
        </div>
        <div class="input">
            <label for="start_date">tangal mulai</label>
        <input type="date" name="start_rent_date" id="start_date" value="{{$order->start_rendt_date}}">
            @error('start_rent_date')
            <p class="error">hari mulai minimal besok</p>
            @enderror
        </div>
        <div class="input">
            <label for="hari">jumlah hari</label>
        <input type="text" name="total_rent_days" id="hari" value="{{$order->total_rent_days}}">
            @error('total_rent_days')
            <p class="error">jumlah hari minimal 1</p>
            @enderror
        </div>
        <button type="submit">edit</button>
    </form>
</div>
@endsection