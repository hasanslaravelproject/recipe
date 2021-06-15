@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">Ingredients</h4>
            </div>

            <div class="searchbar mt-4 mb-5">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <a href="{{ route('ingredients.create') }}" class="btn btn-primary">
                            <i class="icon ion-md-add"></i> Create
                        </a>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Name</th>
                            <th>Measure Unit</th>
                            <th>Company</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($ingredients as $key => $ingredient)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $ingredient->name }}</td>
                            <td>{{ $ingredient->measure_name }}</td>
                            <td>{{ $ingredient->company_name }}</td>
                            <td>
                                <a href="{{ route('ingredients.show', $ingredient->id) }}" title="View details" class="btn btn-info btn-sm"><i class="icon ion-md-eye"></i></a>
                                <a href="{{ route('ingredients.edit',  $ingredient->id) }}" title="Update data" class="btn btn-warning btn-sm"><i class="icon ion-md-create"></i></a>
                                <form action="{{ route('ingredients.destroy',  $ingredient->id) }}" method="POST" onsubmit="return confirm('{{ __('Warning! Ingredient related all data will be lost! Are you sure to delete?') }}')" style="display: inline;">
                                    @csrf  @method('DELETE')
                                    <button title="Delete data" type="submit" class="btn btn-danger btn-sm" ><i class="icon ion-md-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">{!! $ingredients->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
