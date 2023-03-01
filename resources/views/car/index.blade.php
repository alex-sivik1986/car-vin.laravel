@extends('layouts.main')
@section('content')
    <div class="col-md-12">
        <a class="btn btn-success" href="{{ route('cars.export', http_build_query($hrefImport)) }}">Завантажити XLS</a>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            Сортировать
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse col-md-9" id="navbarNavDarkDropdown">
                <select class="form-select sort " name="name" aria-label="Default select example">
                    <option value="">по Імені</option>
                    <option value="sort=name|ASC">З першої літери</option>
                    <option value="sort=name|DESC">З останньої літери</option>
                </select>
                <select class="form-select sort" name="country_number" aria-label="Default select example">
                    <option value="">по Номеру</option>
                    <option value="sort=country_number|ASC">З першої літери</option>
                    <option value="sort=country_number|DESC">З останньої літери</option>
                </select>
                <select class="form-select sort" name="vin_code" aria-label="Default select example">
                    <option value="">по VIN code</option>
                    <option value="sort=vin_code|ASC">З першої літери</option>
                    <option value="sort=vin_code|DESC">З останньої літери</option>
                </select>
                <select class="form-select sort" name="model" aria-label="Default select example">
                    <option value="">по моделі</option>
                    <option value="sort=model|ASC">З першої літери</option>
                    <option value="sort=model|DESC">З останньої літери</option>
                </select>
                <select class="form-select sort" name="make" aria-label="Default select example">
                    <option value="">по Марці</option>
                    <option value="sort=make|ASC">З першої літери</option>
                    <option value="sort=make|DESC">З останньої літери</option>
                </select>
                <select class="form-select sort" name="year" aria-label="Default select example">
                    <option value="">по Року</option>
                    <option value="sort=year|ASC">З першої літери</option>
                    <option value="sort=year|DESC">З останньої літери</option>
                </select>
            </div>
            <form action="{{ route('cars.index') }}" class="d-flex">
                <input class="form-control me-2" @if (!empty(app('request')->query('search'))) value="{{ app('request')->query('search') }}" @endif name="search" placeholder="VIN, номер, ім'я">
                <button class="btn btn-outline-success" type="submit">Пошук</button>
            </form>
        </div>
    </nav>
    <main>
        <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
            @foreach($cars as $car)
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
                            <li> VIN: {{$car->vin_code}}</li>
                        </ul>
                        <a href="{{ route('cars.edit', $car->id) }}" class="w-50 btn btn-lg btn-outline-primary">Редагувати</a>
                        <form action="{{ route('cars.destroy', $car->id) }}" class="btn btn-lg " method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" title="Видалити">Видалити</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div>
            {{ $cars->withQueryString()->links() }}
        </div>
    </main>
@endsection

@section('footer-scripts')
    <script type="text/javascript">
        $("select.sort").bind('change', function(event){
            event.preventDefault();

            const selectedValue = $(this).val();

            @if (app('request')->query('search') !== null)
            const url = "{{route('cars.index')}}?" + selectedValue +
                "&search={{app('request')->query('search')}}";
            document.location = url;
            @else
            const url = "{{route('cars.index')}}?" + selectedValue;
            document.location = url;
            @endif
        });
    </script>
@endsection
