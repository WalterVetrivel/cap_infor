@extends('layouts.master')

@section('content')
    <section id="post" class="py-5">
        <div class="container">
            <div class="card p-5">
                <div class="row">
                    <div class="col-md-8 pr-5 border-right">
                        @if($post->image_url)
                            <img src="{{$post->image_url}}" alt="Image" class="card-img-top img-fluid">
                        @endif
                        <div class="d-flex justify-content-between">
                            <h2 class="mt-4">{{$post->title}}</h2>
                            @isAdmin(Auth::user())
                                <div>
                                    <a href="#" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
                                    <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                </div>
                            @endisAdmin
                        </div>
                        <small class="mb-3 d-inline-block">Posted on {{$post->created_at->format('d-m-Y')}} by {{$post->author}}</small>
                        <p>{{$post->content}}</p>
                    </div>
                    <div class="col-md-4 px-5">
                        <div class="sidebar pt-3">
                            <h3 class="text-center my-3">Recent Posts</h3>
                            <ul class="list-group">
                                @foreach($recent_posts as $recent_post)
                                    <li class="list-group-item">
                                        <a href="{{route('single', $recent_post->id)}}">{{$recent_post->title}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
