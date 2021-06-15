@extends('layouts.app')

@section('content')
    <style>
        .error {
            color: red;
        }
    </style>
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('recipes.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                Create Recipe
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

            <form id="form" action="{{ route('recipes.store') }}" method="post" class="mt-4">
                @csrf

                <div class="form-group">
                    <label for="total_person">Total Person</label>
                    <input type="number" min="1" class="form-control inputs" name="total_person" id="total_person" placeholder="Enter total person" required>
                </div>

                <div class="form-group">
                    <label for="product">Product</label>
                    <select name="product" id="product" class="form-control inputs" required>
                        <option value="">choose one</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>

                <span class="result"></span>
                <br>

                <div class="form-group">
                    <span id="submit">
                        <button class="btn btn-success" type="submit">Submit</button>
                    </span>
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
        $('.inputs').on('change keyup', function(){
            var product = $('#product').val();
            var total_person = $('#total_person').val();
            $('.result').html('<img src="/preloader.gif" alt="..." width="100">');
            $('#submit').html('<button class="btn btn-success" type="submit">Submit</button>');

            if(product != '' && total_person != '' && total_person != 0){
                $('.result').html('<img src="/preloader.gif" alt="..." width="100">');
                $('#submit').html('<button class="btn btn-success" type="submit">Submit</button>');
                $.ajax({
                    url: '/product/info/' + product +'/' + total_person,
                    method: 'GET',
                    success: function (data) {
                        console.log(data);
                        if(data[0] != ''){
                            $('.result').html('');
                            $('.result').html(data[0]);
                            if(jQuery.inArray(true, data[1]) !== -1){
                                $('#submit').html('<a class="btn btn-danger" aria-disabled="true">Not available</a>')
                            }
                        }else{
                            $('.result').html('');
                            $('#submit').html('<a class="btn btn-danger" aria-disabled="true">Not available</a>')
                        }
                    }
                })
            }else{
                $('.result').html('');
                $('#submit').html('<button class="btn btn-success" type="submit">Submit</button>')
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
