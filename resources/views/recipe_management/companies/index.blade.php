@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">Companies</h4>
            </div>

            <div class="searchbar mt-4 mb-5">
                <div class="row">
                    <div class="col-md-12 text-right">
                        @can('company-create')
                        <a href="{{ route('companies.create') }}" class="btn btn-primary">
                            <i class="icon ion-md-add"></i> Create
                        </a>
                        @endcan
                    </div>
                </div>
            </div>
            @can('company-view')
             <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Name</th>
                            <th>Author</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($companies as $key => $company)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->user_name }}</td>
                            <td>
                                @can('company-view')
                                <a href="{{ route('companies.show', $company->id) }}" title="View details" class="btn btn-info btn-sm"><i class="icon ion-md-eye"></i></a>
                                @endcan
                                @can('company-edit')
                                <a href="{{ route('companies.edit',  $company->id) }}" title="Update data" class="btn btn-warning btn-sm"><i class="icon ion-md-create"></i></a>
                                @endcan
                                @can('company-delete')
                                <form action="{{ route('companies.destroy',  $company->id) }}" method="POST" onsubmit="return confirm('{{ __('Warning! Company related all data will be lost! Are you sure to delete?') }}')" style="display: inline;">
                                    @csrf  @method('DELETE')
                                    <button title="Delete data" type="submit" class="btn btn-danger btn-sm" ><i class="icon ion-md-trash"></i></button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">{!! $companies->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
             </div>
            @endcan
        </div>
    </div>
</div>
@endsection
