@extends('layouts.main')
@section('content')
    <form action="{{route('cars.store')}}" method="post">
        @csrf
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="formGroupExampleInput">Ім'я</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="formGroupExampleInput" placeholder="Ваше ім'я">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="formGroupExampleInput2">Державний номер</label>
                <input type="text" name="country_number" class="form-control @error('country_number') is-invalid @enderror" id="formGroupExampleInput2" placeholder="номер автомобіля">
                @error('country_number')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="formGroupExampleInput3">Колір</label>
                <input type="text" name="color" class="form-control @error('color') is-invalid @enderror" id="formGroupExampleInput3" placeholder="колір автомобіля">
                @error('color')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="formGroupExampleInput4">VIN-CODE</label>
                <input type="text" name="vin_code" class="form-control @error('vin_code') is-invalid @enderror" id="formGroupExampleInput4" placeholder="Vin-code автомобіля">
                @error('vin_code')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <button type="submit" class="btn btn-primary">Зберегти</button>
        </div>
        @error('model')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @error('make')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </form>
@endsection
