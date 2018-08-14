@extends('layouts.master')
@section('content')
<section id="featured" class="py-5">
    <div class="container">
        <h1 class="mb-4">Welcome to Caprivi Archives</h1>
        <div class="row">
            <div class="col-12">
                <div class="card featured-post">
                    <div class="row">
                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1c/Book_sale_loot_%284552277923%29.jpg/1280px-Book_sale_loot_%284552277923%29.jpg" alt="Image" class="img-fluid">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body py-5">
                                <h2 class="mb-3">{{$featured_post[0]->title}}</h2>
                                <span class="text-muted d-inline-block mb-3">{{$featured_post[0]->created_at->format('d-m-Y')}}</span>
                                <p>{{$featured_post[0]->content}}</p>
                                <hr>
                                <div class="text-right">
                                    <a href="{{route('single', $featured_post[0]->id)}}" class="btn btn-primary">Continue reading &gt;&gt;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <h2 class="mb-4 text-white text-center">Recent Posts</h2>
                </div>
                @for($i = 0;($i < 3 && $i < count($recent_posts));$i++)
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1c/Book_sale_loot_%284552277923%29.jpg/1280px-Book_sale_loot_%284552277923%29.jpg" alt="Image" class="img-fluid card-img-top">
                        <div class="card-body">
                            <h3>{{$recent_posts[$i]->title}}</h3>
                            <small class="text-muted mb-3 d-inline-block">{{$recent_posts[$i]->created_at->format('d-m-Y')}}</small>
                            <p>{{$recent_posts[$i]->content}}</p>
                        </div>
                        <div class="card-footer text-right">
                            <a href="{{route('single', $recent_posts[$i]->id)}}" class="btn btn-primary">Continue reading &gt;&gt;</a>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>
</section>
@endsection
