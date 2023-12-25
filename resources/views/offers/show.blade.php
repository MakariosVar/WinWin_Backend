@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">
                    {{ $offer->name }}
                    @if ($offer->sponsored)
                        <i class="bi bi-star-fill text-warning" title="Χορηγούμενη"></i>
                    @endif
                </h5>
                <div class="card-body">
                    <div class="row">
                        @if ($offer->image)
                            <div class="col-3 px-5">
                                <div class="w-100">
                                    <img src="{{ asset('storage/' . $offer->image) }}" alt="Photo" class="w-100">
                                </div>
                            </div>
                        @endif
                        <div class="col-9">
                            <dl class="row">
                                <dt class="col-sm-3">Απομένουν:</dt>
                                <dd class="col-sm-9">
                                    @if ($offer->amount)
                                        <b>{{ $offer->amount }}</b> <span class="text-muted">(από {{ $offer->amount }})</span> <!-- TOFIX -->
                                    @else
                                        <i class="bi bi-infinity"></i>                                       
                                    @endif
                                </dd>
                                <dt class="col-sm-3">Δημιουργήθηκε:</dt>
                                <dd class="col-sm-9">
                                    {{ $offer->created_at->format('Y-m-d') }}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection