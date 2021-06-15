@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('ingredients.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                    Edit Ingredient
                </h4>

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post" action="{{ route('ingredients.update', $ingredient->id) }}" class="mt-4">
                    @csrf @method('PUT')

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $ingredient->name }}" placeholder="Enter ingredient name" required>
                    </div>

                    <div class="form-group">
                        <label for="measure_unit">Measure Unit</label>
                        <select name="measure_unit" id="measure_unit" class="form-control" required>
                            <option value="">choose one</option>
                            @foreach($measures as $measure)
                                <option value="{{ $measure->id }}" @if($ingredient->measure_unit == $measure->id ) selected @endif>{{ $measure->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="company">Company</label>
                        <select name="company" id="company" class="form-control" required>
                            <option value="">choose one</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" @if($ingredient->company_id == $company->id ) selected @endif>{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-success btn-sm" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
