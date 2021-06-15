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
                    Edit Recipe
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

                <form id="form" action="{{ route('recipes.update', $recipe->id) }}" method="post" class="mt-4">
                    @csrf @method('PUT')

                    <div class="form-group">
                        <label><b>Status</b></label><br>
                        <label>
                            <input type="radio" value="1" name="status" @if($recipe->status == 1) checked @endif> In Stock
                        </label>
                        <label>
                            <input type="radio" value="2" name="status" @if($recipe->status == 2) checked @endif> Delivered
                        </label>
                    </div>

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
                $('#submit').html('<button class="btn btn-success" type="submit">Submit</button>')

                if(product != '' && total_person != ''){
                    $('.result').html('<img src="/preloader.gif" alt="..." width="100">');
                    $('#submit').html('<button class="btn btn-success" type="submit">Submit</button>')
                    $.ajax({
                        url: '/product/info/' + product +'/' + total_person,
                        method: 'GET',
                        success: function (data) {
                            $('.result').html('');
                            var i = 0;
                            for(i = 0; i < data[0].length; i++){
                                $('.result').append(data[0][i]+'</br>');
                                if(data[1][i] == true){
                                    $('#submit').html('<a class="btn btn-danger" aria-disabled="true">Not available</a>')
                                }
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
