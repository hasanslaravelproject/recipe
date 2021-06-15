@extends('layouts.app')

@section('content')
    <style>
        .more_ingredient_area {
            border: 1px solid #e9e9e9;
            padding: 6px 8px;
            margin: 6px 0;
        }
    </style>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('products.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                    View Product
                </h4>
                    <div class="form-group">
                        <label for="company">Company</label>
                        <select name="company" id="company" class="form-control" disabled>
                            <option value="">choose one</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" @if($product->company_id == $company->id) selected @endif>{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $product->name }}" id="name" placeholder="Enter product name" readonly>
                    </div>

                    @foreach($ingredient_in_product as $k => $ingredient_in)
                        <div class="more_ingredient_area">
                            <h5>Ingredient for 1 person</h5>

                            <div class="form-group">
                                <label for="ingredient">Ingredient</label>
                                <select name="ingredient[]" id="ingredient" class="form-control " disabled>
                                    <option value="">choose one</option>
                                    @foreach($ingredients as $ingredient)
                                        <option value="{{ $ingredient->id }}" @if($ingredient_in->ingredient_id == $ingredient->id) selected @endif>{{ $ingredient->name }} ({{ $ingredient->measure_name }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="quantity">Quantity for 1 person</label>
                                <input type="number" class="form-control" min="1" value="{{ $ingredient_in->quantity }}" name="quantity[]" id="quantity" placeholder="Enter quantity for 1 person" readonly>
                            </div>
                        </div>
                    @endforeach
            </div>
        </div>
    </div>
@endsection
