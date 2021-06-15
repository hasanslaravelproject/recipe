@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('companies.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                    View company
                </h4>

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" value="{{ $company->name }}" readonly>
                </div>

                <div class="form-group">
                    <label for="author">Author</label>
                    <select name="author" id="author" class="form-control" disabled>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" @if($user->id == $company->user_id) selected @endif>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
@endsection
