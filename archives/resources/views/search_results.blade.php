@extends('layouts.master')

@section('content')
    <section id="search_results" class="py-5">
        <div class="container">
            <h2 class="my-3">Search Results</h2>
            @if(isset($results) && count($results) > 0)
                @foreach($results as $post)
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h3>{{$post->title}}</h3>
                                @isAdmin(Auth::user())
                                    <div>
                                        <a href="#" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
                                        <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                    </div>
                                @endisAdmin
                            </div>
                            <p>{{ str_limit($post->content, 200) }}</p>
                            <a href="{{route('single', $post->id)}}" class="btn btn-primary">Read More &gt;&gt;</a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-danger py-5">
                    No results found.
                </div>
            @endif
        </div>
    </section>
@endsection
