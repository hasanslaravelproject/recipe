@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">Measures</h4>
            </div>

            <div class="searchbar mt-4 mb-5">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <a href="{{ route('measures.create') }}" class="btn btn-primary">
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
                            <th>Company</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($measures as $key => $measure)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $measure->name }}</td>
                            <td>{{ $measure->company_name }}</td>
                            <td>
                                <a href="{{ route('measures.show', $measure->id) }}" title="View details" class="btn btn-info btn-sm"><i class="icon ion-md-eye"></i></a>
                                <a href="{{ route('measures.edit',  $measure->id) }}" title="Update data" class="btn btn-warning btn-sm"><i class="icon ion-md-create"></i></a>
                                <form action="{{ route('measures.destroy',  $measure->id) }}" method="POST" onsubmit="return confirm('{{ __('Warning! Measure related all data will be lost! Are you sure to delete?') }}')" style="display: inline;">
                                    @csrf  @method('DELETE')
                                    <button title="Delete data" type="submit" class="btn btn-danger btn-sm" ><i class="icon ion-md-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">{!! $measures->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
