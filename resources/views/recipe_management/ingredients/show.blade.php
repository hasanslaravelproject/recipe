@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('ingredients.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                    View Ingredient
                </h4>

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" value="{{ $ingredient->name }}" readonly>
                </div>

                <div class="form-group">
                    <label for="measure_unit">Measure Unit</label>
                    <select name="measure_unit" id="measure_unit" class="form-control" disabled>
                        @foreach($measures as $measure)
                            <option value="{{ $measure->id }}" @if($ingredient->measure_unit == $measure->id ) selected @endif>{{ $measure->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="measure_unit">Company</label>
                    <select name="measure_unit" id="measure_unit" class="form-control" disabled>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}" @if($ingredient->company_id == $company->id ) selected @endif>{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
@endsection
