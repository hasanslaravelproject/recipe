@extends('layouts.app')

@section('content')
    <style>
        .error {
            color: #ee0303;
        }
    </style>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('stocks.show','stock-history') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                    Edit Stock
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

                <form id="form" action="{{ route('stocks.update', $stock->id) }}" method="post" class="mt-4">
                    @csrf @method('PUT')

                    <div class="form-group">
                        <label for="ingredient">Ingredient</label>
                        <select name="ingredient" id="ingredient" class="form-control" required>
                            <option value="">choose one</option>
                            @foreach($ingredients as $ingredient)
                                <option value="{{ $ingredient->id }}" @if($stock->ingredient_id == $ingredient->id) selected @endif>{{ $ingredient->name }} ({{ $ingredient->measure_name }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Quantity @if($stock->spending_total != 0)<span class="text-danger">(already spend {{ $stock->spending_total }})</span> @endif</label>
                        <input type="number" @if($stock->spending_total != 0)min="{{ $stock->spending_total }}" @else min="1" @endif class="form-control" value="{{ $stock->quantity }}" name="quantity" id="quantity" placeholder="Enter quantity" required>
                    </div>

                    <div class="form-group">
                        <label for="expire_date">Ingredient expire date</label>
                        <input type="date" class="form-control" value="{{ $stock->date_expire }}" name="expire_date" id="expire_date" required>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-success btn-sm" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/toastr.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            var today = new Date();
            var dd = String(today. getDate()). padStart(2, '0');
            var mm = String(today. getMonth() + 1). padStart(2, '0'); //January is 0!
            var yyyy = today. getFullYear();
            today = yyyy + '-' + mm + '-' + dd;

            var date_expire = $('#expire_date');
            date_expire.attr('min', today);
        });

        $("#form").validate(
                {
                    ignore: [],
                    debug: false,
                    rules: {},
                    messages: {}
                });
    </script>

@endsection
