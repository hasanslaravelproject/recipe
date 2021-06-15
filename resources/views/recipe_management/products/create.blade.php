@extends('layouts.app')

@section('content')
    <style>
        .error {
            color: red;
        }
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
                Create Product
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

            <form id="form" action="{{ route('products.store') }}" method="post" class="mt-4">
                @csrf

                <div class="form-group">
                    <label for="company">Company</label>
                    <select name="company" id="company" class="form-control" required>
                        <option value="">choose one</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter product name" required>
                </div>

                <div class="more_ingredient_area">

                    <h5>Ingredient for 1 person</h5>

                    <div class="form-group">
                        <label for="ingredient">Ingredient</label>
                        <select name="ingredient[]" id="ingredient" class="form-control ingredients" required>
                            <option value="">choose one</option>
                            @foreach($ingredients as $ingredient)
                                <option value="{{ $ingredient->id }}">{{ $ingredient->name }} ({{ $ingredient->measure_name }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Quantity for 1 person</label>
                        <input type="number" class="form-control" min="1" name="quantity[]" id="quantity" placeholder="Enter quantity for 1 person" required>
                    </div>
                </div>

                <span id="more_ingredient"></span>
                <a class="btn btn-primary btn-sm mb-2" id="add_ingredient">Add more Ingredient</a>

                <div class="form-group">
                    <button class="btn btn-success" type="submit">Submit</button>
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
        var i = 0;
        $('#add_ingredient').on('click', function(){
            $('#more_ingredient').append('<div class="more_ingredient_area">' +
                    '<span class="btn btn-danger btn-sm ml-2 remove" id="'+i+'">&times;</span>'+
                    '<h5>Ingredient for 1 person</h5>'+
                    '<div class="form-group">'+
            '<label for="">Ingredient</label>'+
            '<select name="ingredient[]" id="ingredient" class="form-control ingredients u_s_'+i+'" required>'+
                '<option value="">choose one</option>'+
                @foreach($ingredients as $ingredient)
                    '<option value="{{ $ingredient->id }}">{{ $ingredient->name }} ({{ $ingredient->measure_name }})</option>'+
                @endforeach
            '</select>'+
            '</div>'+

            '<div class="form-group">'+
                '<label for="">Quantity for 1 person</label>'+
                '<input type="number" class="form-control" min="0" name="quantity[]" id="" placeholder="Enter quantity for 1 person" required>'+
            '</div>'+
            '</div>');
            i++;
        });

        var used_ingredients = [];

        $(document).on('click','.remove', function(){
            var this_id = $(this).attr('id');
            var hasused = $('.u_s_'+this_id).hasClass('used');
            if(hasused == true){
                var used = $('.u_s_'+this_id).attr('used');
                used_ingredients = jQuery.grep(used_ingredients, function(value) {
                    return value != used;
                });
            }
            console.log(used);

            $(this).parent('.more_ingredient_area').remove();

        });

        $(document).on('change','.ingredients', function(){
            var this_val = $(this).val();
            var hasused = $(this).hasClass('used');
            if(hasused == true){
                var used = $(this).attr('used');
                if(this_val != used){
                    used_ingredients = jQuery.grep(used_ingredients, function(value) {
                        return value != used;
                    });
                }
            }

            if(jQuery.inArray(this_val, used_ingredients) !== -1) {
                alert('Alredy added this ingredient!');
                $(this).val('');
            } else {
                used_ingredients.push(this_val);
                $(this).addClass('used');
                $(this).attr('used', this_val);
            }
        });
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
