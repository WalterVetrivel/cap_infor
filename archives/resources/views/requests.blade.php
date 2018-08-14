@extends('layouts.master')
@section('content')
    <div class="container">
    @isAdmin(Auth::user())
        <h2 class="my-4">Membership requests</h2>
        @if(isset($requests) && count($requests) > 0)
        @foreach($requests as $request)
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <p class="m-0">{{$request->name}} | {{$request->email}}</p>
                    <div class="d-flex ml-auto">
                        <form action="{{route('approve', $request->id)}}" method="post" class="mr-3">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Approve</button>
                        </form>
                        <form action="{{route('reject', $request->id)}}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    {{$request->reason}}
                </div>
            </div>
        @endforeach
        @else
        <div class="alert alert-info">No pending requests.</div>
        @endif
    @else
        <div class="alert alert-danger py-5">You are not authorized to access this page.</div>
    @endisAdmin
    </div>
@endsection
