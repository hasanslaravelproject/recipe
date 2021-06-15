@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('measures.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                Create Measure
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

            <form id="form" action="{{ route('measures.store') }}" method="post" class="mt-4">
                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter measure name" required>
                </div>

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
                    <button class="btn btn-success btn-sm" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
