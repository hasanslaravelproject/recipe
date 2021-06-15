@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">Products</h4>
            </div>

            <div class="searchbar mt-4 mb-5">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <a href="{{ route('products.create') }}" class="btn btn-primary">
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
                            <th>Company</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $key => $product)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->company_name }}</td>
                            <td>
                                <a href="{{ route('products.show',  $product->id) }}" title="View details" class="btn btn-info btn-sm"><i class="icon ion-md-eye"></i></a>
                                <a href="{{ route('products.edit',  $product->id) }}" title="Update data" class="btn btn-warning btn-sm"><i class="icon ion-md-create"></i></a>
                                <form action="{{ route('products.destroy',  $product->id) }}" method="POST" onsubmit="return confirm('{{ __('Warning! Stock related all data will be lost! Are you sure to delete?') }}')" style="display: inline;">
                                    @csrf  @method('DELETE')
                                    <button title="Delete data" type="submit" class="btn btn-danger btn-sm" ><i class="icon ion-md-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $products->render() !!}
            </div>
        </div>
    </div>
</div>
@endsection
