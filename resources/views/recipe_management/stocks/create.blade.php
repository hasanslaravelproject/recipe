@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('stocks.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                Create Stock
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

            <form id="form" action="{{ route('stocks.store') }}" method="post" class="mt-4">
                @csrf

                <div class="form-group">
                    <label for="ingredient">Ingredient</label>
                    <select name="ingredient" id="ingredient" class="form-control" required>
                        <option value="">choose one</option>
                        @foreach($ingredients as $ingredient)
                            <option value="{{ $ingredient->id }}">{{ $ingredient->name }} ({{ $ingredient->measure_name }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" min="1" class="form-control" name="quantity" id="quantity" placeholder="Enter quantity" required>
                </div>

                <div class="form-group">
                    <label for="expire_date">Ingredient expire date</label>
                    <input type="date" min="1" class="form-control" name="expire_date" id="expire_date" required>
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
        date_expire.val(today);
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
