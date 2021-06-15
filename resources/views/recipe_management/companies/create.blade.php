@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('companies.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                Create Company
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

            <form id="form" action="{{ route('companies.store') }}" method="post" class="mt-4">
                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter company name" required>
                </div>

                <div class="form-group">
                    <label for="author">Author</label>
                    <select name="author" id="author" class="form-control" required>
                        <option value="">choose one</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
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
