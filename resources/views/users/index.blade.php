@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="d-flex justify-content-arround card-header">
                        <h5 class="col d-flex align-items-center mb-0">
                            Χρήστες ({{ $usersCounter ?? 0 }})
                        </h5>
                        <div class="col text-end">
                            <a href="{{ route('users.create') }}" title="Προσθήκη" class="btn btn-primary">+</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <th style="width:2%">
                                    ID
                                </th>
                                <th>
                                    Username
                                </th>
                                <th>
                                    Πόντοι  
                                </th>
                                <th>
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            {{ $user->id }}
                                        </td>
                                        <td>
                                            {{ $user->username }}
                                            @if ($user->isAdmin())
                                                <i class="bi bi-hammer text-danger" title="ADMIN"></i>
                                            @endif
                                            @if (!empty($user->email_verified_at))
                                                <i class="bi bi-patch-check-fill text-primary" title="Verified Email"></i>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $user->points ?? 0 }}
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('users.show', $user->id) }}" class="text-decoration-none">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            | 
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
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