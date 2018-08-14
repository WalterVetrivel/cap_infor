@extends('layouts.master')

@section('content')
    <section id="archives" class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h1>Explore our archives</h1>
                </div>
                <div class="col-6">
                    <form method="GET" action="{{ route('archives') }}">
                        @csrf
                        <div class="form-group">
                            <label for="year">Select Year</label>
                            <div class="d-flex">
                                <select name="year" id="year" class="form-control">
                                    @foreach($years as $year)
                                        <option value="{{$year}}" @if($year == $selected_year) selected @endif>{{$year}}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-primary">Search Archives</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row accordion mt-3" id="accordion">
                <div class="col-md-3">
                    @foreach($months as $month)
                        <button class="btn btn-danger btn-lg btn-block collapsed" type="button" data-toggle="collapse" data-target="#{{$month}}">{{$month}}</button>
                    @endforeach
                </div>
                <div class="col-md-9">
                    @foreach($months as $month)
                        @if($month == $first_month)
                            <div class="card posts-by-month py-3 collapse show" data-parent="#accordion" id="{{$month}}">
                        @else
                            <div class="card posts-by-month py-3 collapse" data-parent="#accordion" id="{{$month}}">
                        @endif
                                <h2 class="mx-4">{{$month}} - {{$selected_year}}</h2>
                                <div class="card-body px-5">
                                    @foreach($posts_by_month as $post)
                                        @if($month == (date('F', strtotime("2018-".$post->created_at->month."-01"))))
                                            <div class="post">
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
                                            <hr>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
