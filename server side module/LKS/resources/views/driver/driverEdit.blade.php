@extends('layouts.main')
@section('title','edit driver')
@section('content')
<div class="form">
    <form action="/driver/{{$driver->id}}" method="POST">
        @csrf
        @method('patch')
        <div class="form-title">
                <h1>Edit driver</h1>
            </div>
        <div class="input">
            <label for="name">nama:</label>
        <input type="text" name="name" id="name" value="{{$driver->name}}">
            @error('name')
                <p class="error">nama harus di isi</p>
            @enderror
        </div>
        <div class="input">
            <label for="age">usia : </label>
        <input type="number" name="age" id="age" value="{{$driver->age}}">
        @error('age')
        <p class="error">usia harus di isi dan minimal 18</p> 
        @enderror
        </div>
        <div class="input">
            <label for="id_numbers">id driver : </label>
        <input type="text" name="id_numbers" id="id_numbers" value="{{$driver->id_numbers}}">
            @error('id_numbers')
            <p class="error">id driver harus di isi dan minimal 16 huruf</p>
            @enderror
        </div>
        <button type="submit">edit</button>
    </form>
</div>
@endsection