@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">Stock History of Ingredients</h4>
                    <p>Date: {{ date("d F Y", time()) }}</p>
                </div>

                <div class="searchbar mt-4">
                    <div class="searchbar mt-4 mb-4">
                        <div class="row">
                            <div class="col-md-6 text-left">
                                <a href="{{ route('stocks.index') }}" class="btn btn-info text-light">
                                    <i class="icon ion-md-eye"></i> Current Stock of Ingredients
                                </a>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('stocks.create') }}" class="btn btn-primary">
                                    <i class="icon ion-md-add"></i> Create
                                </a>
                            </div>
                        </div>
                    <form id="form" action="{{ route('searchStock') }}" method="get">
                        <div class="row mt-4">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" @if(isset($_GET['date'])) value="{{ $_GET['date'] }}" @endif class="form-control" name="date" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Ingredient</label>
                                    <select name="ingredient" id="ingredient" class="form-control">
                                        <option value="">choose one</option>
                                        @foreach($ingredients as $ingredient)
                                            <option value="{{ $ingredient->id }}" @if(isset($_GET['ingredient']) && $_GET['ingredient'] == $ingredient->id) selected @endif>{{ $ingredient->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 mt-4">
                                <div class="form-group">
                                    <button class="btn btn-success" type="submit">Search</button>
                                    <a href="{{ route('stocks.show','stock-history') }}" class="btn btn-danger">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Ingredient</th>
                            <th>Added</th>
                            <th>Spend</th>
                            <th>Current In total</th>
                            <th>Expire Total</th>
                            <th>Expire Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $x = 0; @endphp
                        @foreach($created_dates as $created_date)
                            <tr>
                                <td colspan="8"><b>{{ date('d-m-Y', strtotime($created_date)) }}</b></td>
                            </tr>
                            @foreach($all_stocks as $key => $stock)
                                @if(date('Y-m-d', strtotime($stock->created_at)) == $created_date)
                                 <tr>
                                     <td></td>
                                    <td>{{ $stock->ingredient_name }}</td>
                                    <td>{{ $stock->quantity }} {{ $stock->measure_name }}</td>
                                    <td>@if($stock->spending_total == null || $stock->spending_total == 0 ) 0 @else {{ $stock->spending_total }} {{ $stock->measure_name }} @endif</td>
                                    <td>
                                        @if(date("Y-m-d", time()) <= date('Y-m-d', strtotime($stock->date_expire)))
                                            {{ $stock->quantity - $stock->spending_total }} {{ $stock->measure_name }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                    <td>
                                        @if(date("Y-m-d", time()) > date('Y-m-d', strtotime($stock->date_expire)))
                                            {{ $stock->quantity - $stock->spending_total }} {{ $stock->measure_name }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                    <td>{{ date('d F Y', strtotime($stock->date_expire)) }}</td>
                                    <td>
                                        @if(date("Y-m-d", time()) <= date('Y-m-d', strtotime($stock->date_expire)))
                                            @if($stock->quantity != $stock->spending_total)
                                                <a href="{{ route('stocks.edit',  $stock->id) }}" title="Update data" class="btn btn-warning btn-sm"><i class="icon ion-md-create"></i></a>
                                                <form action="{{ route('stocks.destroy',  $stock->id) }}" method="POST" onsubmit="return confirm('{{ __('Warning! Stock related all data will be lost! Are you sure to delete?') }}')" style="display: inline;">
                                                    @csrf  @method('DELETE')
                                                    <button title="Delete data" type="submit" class="btn btn-danger btn-sm" ><i class="icon ion-md-trash"></i></button>
                                                </form>
                                            @else
                                                <center>
                                                    <span title="Update and delete not available" class="text-danger" style="font-size: 20px; cursor: not-allowed;"><b>&empty;</b></span>
                                                </center>
                                            @endif
                                        @else
                                            <center>
                                                <span title="Update and delete not available" class="text-danger" style="font-size: 20px; cursor: not-allowed;"><b>&empty;</b></span>
                                            </center>
                                        @endif
                                    </td>
                                 </tr>
                                @endif
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                    {!! $all_stocks->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
