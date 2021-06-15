@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">Recipes</h4>
            </div>

            <div class="searchbar mt-4 mb-5">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <a href="{{ route('recipes.create') }}" class="btn btn-primary">
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
                            <th>Product Name</th>
                            <th>Total Person</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($recipes as $key => $recipe)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $recipe->products_name }}</td>
                            <td>{{ $recipe->total_person }}</td>
                            <td>
                                @if($recipe->status == 1)
                                    <span class="badge badge-primary">In stock</span>
                                @elseif($recipe->status == 2)
                                    <span class="badge badge-success">Delivered</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('recipes.show',  $recipe->id) }}" title="View details" class="btn btn-info btn-sm"><i class="icon ion-md-eye"></i></a>
                                <a href="{{ route('recipes.edit',  $recipe->id) }}" title="Update data" class="btn btn-warning btn-sm"><i class="icon ion-md-create"></i></a>
                                <form action="{{ route('recipes.destroy',  $recipe->id) }}" method="POST" onsubmit="return confirm('{{ __('Warning! Are you sure to delete?') }}')" style="display: inline;">
                                    @csrf  @method('DELETE')
                                    <button title="Delete data" type="submit" class="btn btn-danger btn-sm" ><i class="icon ion-md-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $recipes->render() !!}
            </div>
        </div>
    </div>
</div>
@endsection
