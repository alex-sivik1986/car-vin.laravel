@extends('layouts.main')
@section('content')
    <main>
        <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <div class="card-header py-3">
                            <h4 class="my-0 fw-normal">Ім'я: {{$car->name}}</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mt-3 mb-4">
                                <li> Модель: {{$car->model}}</li>
                                <li> Марка: {{$car->make}}</li>
                                <li> Номер: {{$car->country_number}}</li>
                                <li> Рік: {{$car->year}}</li>
                            </ul>
                            <a href="{{ route('cars.edit', $car->id) }}" class="w-100 btn btn-lg btn-outline-primary">Редагувати</a>
                        </div>
                    </div>
                </div>
        </div>
    </main>
@endsection
