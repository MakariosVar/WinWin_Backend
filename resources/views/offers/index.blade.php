@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="d-flex justify-content-arround card-header">
                    <h5 class="col d-flex align-items-center mb-0">
                        Προσφορές ({{ $offersCounter ?? 0 }})
                    </h5>
                    <div class="col text-end">
                        <a href="{{ route('offers.create') }}" title="Προσθήκη" class="btn btn-primary">+</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <th style="width:2%">
                                ID
                            </th>
                            <th>
                                Εικόνα
                            </th>
                            <th>
                                Όνομα
                            </th>
                            <th>
                                Ποσότητα
                            </th>
                            <th>
                            </th>
                        </thead>
                        <tbody>
                            @foreach ($offers as $offer)
                                <tr>
                                    <td>
                                        {{ $offer->id }}
                                    </td>
                                    <td width="10%">
                                        @if ($offer->image)
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal{{$offer->id}}">
                                                <div>
                                                    <img src="{{ asset('storage/' . $offer->image) }}" class="img-thumbnail w-100" alt="Photo">
                                                </div>
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="imageModal{{$offer->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img src="{{ asset('storage/' . $offer->image) }}" class="img-thumbnail w-100" alt="Photo">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $offer->name }}
                                        @if ($offer->sponsored)
                                            <i class="bi bi-star-fill text-warning" title="Χορηγούμενη"></i>
                                        @endif
                                    </td>
                                    <td>
                                        {!! $offer->amount ? $offer->amount : '<i class="bi bi-infinity"></i>' !!}
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('offers.show', $offer->id) }}" class="text-decoration-none">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        | 
                                        <a href="{{ route('offers.edit', $offer->id) }}" class="text-decoration-none">
                                            <i class="bi bi-pencil"></i>
                                        </a> 
                                        |
                                        <form action="{{ route('offers.destroy', $offer->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger p-0" onclick="return confirm('Are you sure you want to delete this offer?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection