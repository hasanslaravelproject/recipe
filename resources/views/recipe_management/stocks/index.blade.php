@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">Current Stock of Ingredients</h4>
                <p>Date: {{ date("d F Y", time()) }}</p>
            </div>

            <div class="searchbar mt-4 mb-5">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <a href="{{ route('stocks.show','stock-history') }}" class="btn btn-info text-light">
                            <i class="icon ion-md-eye"></i> Stock History of Ingredients
                        </a>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ route('stocks.create') }}" class="btn btn-primary">
                            <i class="icon ion-md-add"></i> Create
                        </a>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Ingredient</th>
                            <th>Current In total</th>
                            <th>Expire Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($ingredients as $key => $ingredient)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $ingredient->name }}</td>
                            <td>
                                @php
                                $qty = 0; $spending = 0;$unit = '';
                                @endphp
                                @foreach($current_stocks as $key => $stock)
                                    @if($stock->ingredient_id == $ingredient->id)
                                        @php
                                        $qty+= $stock->quantity;
                                        $spending+= $stock->spending_total;
                                        $unit = $stock->measure_name;
                                        @endphp
                                    @endif
                                @endforeach
                                @if(($qty - $spending) <= 0)
                                    0
                                @else
                                    {{ $qty - $spending }} {{ $unit }}
                                @endif
                            </td>
                            <td>
                                @foreach($current_stocks as $key => $stock)
                                    @if($stock->ingredient_id == $ingredient->id)
                                    @if($stock->quantity != $stock->spending_total)
                                        <b>{{ $stock->quantity - $stock->spending_total }} {{ $stock->measure_name }}</b> : {{ date("d F Y", strtotime($stock->date_expire))}}
                                        <br>
                                    @endif
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $ingredients->render() !!}
            </div>
        </div>
    </div>
</div>
@endsection
