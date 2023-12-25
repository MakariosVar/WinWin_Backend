@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">
                    <b>
                        {{ $user->username }}
                    </b>
                    @if ($user->isAdmin())
                        <i class="bi bi-hammer text-danger" title="ADMIN"></i>
                    @endif
                    @if (!empty($user->email_verified_at))
                        <i class="bi bi-patch-check-fill text-primary" title="Verified Email"></i>
                    @endif
                </h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <dl class="row">
                                <dt class="col-sm-3">Πόντοι:</dt>
                                <dd class="col-sm-9">
                                    <b>{{ $user->points ?? 0 }}</b>
                                </dd>
                                <dt class="col-sm-3">Δημιουργήθηκε:</dt>
                                <dd class="col-sm-9">
                                    {{ $user->created_at->format('Y-m-d') }}
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