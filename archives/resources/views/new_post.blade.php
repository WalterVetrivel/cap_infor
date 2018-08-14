@extends('layouts.master')

@section('content')
    <section id="add_post" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if(session()->has('status'))
                        @if(session('status'))
                            <div class="alert-success p-3 mb-3">
                                Post added successfully!
                            </div>
                        @else
                            <div class="alert-danger p-3 mb-3">
                                Unable to add post
                            </div>
                        @endif
                    @endif
                    <h2 class="mb-3">Add new post</h2>
                    <form action="{{route('add_post')}}" method="post">
                        @csrf
                        <label for="#title">Post title</label>
                        <input type="text" class="form-control" id="title" name="title" required><br>
                        <label for="#author">Author</label>
                        <input type="text" class="form-control" id="author" name="author"><br>
                        <label for="#post_content">Post content</label>
                        <textarea name="content" id="#post_content" cols="30" rows="30" class="form-control"></textarea><br>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="publish" checked name="publish">
                                <label class="custom-control-label" for="publish">Publish</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="protect" name="protect">
                                <label class="custom-control-label" for="protect">Protect</label>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
