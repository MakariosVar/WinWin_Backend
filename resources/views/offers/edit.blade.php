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
                    <h5 class="text-center">Επεξεργασία Προσφοράς</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('offers.update', $offer->id) }}" class="px-5 row" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Use PUT method for update -->

                        <div class="mb-3 col-9">
                            <label for="input-name" class="form-label">Όνομα</label>
                            <input type="text" class="form-control" id="input-name" name="name" value="{{ old('name', $offer->name) }}">
                        </div>

                        <div class="mb-1 col-3">
                            <label for="input-amount" class="form-label">Ποσότητα</label>
                            <input type="text" class="form-control" id="input-amount" name="amount" aria-describedby="amountHelp" value="{{ old('amount', $offer->amount) }}">
                            <div id="amountHelp" class="form-text">Αφήστε κενό για επαναλαμβανόμενη προσφορά.</div>    
                        </div>

                        <div class="mb-3 col-12">
                            <label for="imageForm" class="form-label">Εικόνα</label>
                            <input class="form-control" type="file" id="imageForm" name="image">
                        </div>

                        <div class="mb-3 col-12">
                            <input class="form-check-input" type="checkbox" value="1" id="sponsored" name="sponsored" {{ $offer->sponsored ? 'checked' : '' }}>
                            <label class="form-check-label" for="sponsored">
                                Χορηγούμενη
                            </label>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Αποθήκευση</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
