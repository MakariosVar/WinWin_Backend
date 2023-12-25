@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body text-center">
                    <h3>
                        Δώρα: <a href="{{ route('offers.index') }}" class="link-dark">{{ $offersCounter }}</a>
                    </h3>
                    <h3>
                        Χρήστες: <a href="{{ route('users.index') }}" class="link-dark">{{ $usersCounter }}</a>
                    </h3>
                    <div class="col-100">
                        <img src="/images/logo_test.jpeg" alt="test_logo" class="w-25 rounded-circle">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
