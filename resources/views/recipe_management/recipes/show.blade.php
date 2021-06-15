@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('recipes.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                    Show Recipe
                </h4>

                <div class="form-group">
                    <label for="total_person">Total Person</label>
                    <input type="number" min="1" class="form-control inputs" value="{{ $recipe->total_person }}" readonly>
                </div>

                <div class="form-group">
                    <label for="product">Product</label>
                    <select name="product" id="product" class="form-control inputs" disabled>
                        <option value="">choose one</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" @if($product->id == $recipe->product_id) selected @endif>{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
@endsection
