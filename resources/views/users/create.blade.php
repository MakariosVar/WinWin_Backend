@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="col-12 card p-0">
            <div class="card-header">
                <h5 class="text-center">Δημιουργία Χρήστη</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('users.store') }}" class="px-5 row" enctype="multipart/form-data">
                    @csrf <!-- CSRF token -->
                    <div class="mb-3 col-12">
                      <label for="input-name" class="form-label">Username</label>
                      <input type="text" class="form-control" id="input-name" name="username">
                    </div>

                    <div class="mb-3 col-12">
                        <label for="input-name" class="form-label">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email">
                    </div>

                    <div class="mb-3 col-12">
                        <label for="input-password" class="form-label">Κωδικός</label>
                        <input type="text" class="form-control" id="input-password" name="password">
                    </div>

                    <div class="mb-3 col-12">
                        <input class="form-check-input" type="checkbox" value="1" id="verified" name="verified">
                        <label class="form-check-label" for="verified">
                            Επαληθευμένο Email
                        </label>
                    </div>
                    
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Προσθήκη</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection