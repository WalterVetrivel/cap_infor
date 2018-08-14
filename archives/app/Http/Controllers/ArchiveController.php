<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;
use Faker\Provider\DateTime;

class ArchiveController extends Controller
{
    public function index() {
        $featured_post = Post::where('is_featured', true)->where('is_published', true)->limit(1)->get();
        if($featured_post) {
            $recent_posts = Post::orderBy('created_at', 'desc')->limit(3)->get();
        } else {
            $recent_posts = Post::orderBy('created_at', 'desc')->limit(4)->get();
            $featured_post = $recent_posts[0];
            $recent_posts = array_slice($recent_posts, 1);
        }
        return view('home', compact('featured_post', 'recent_posts'));
    }

    public function archives(Request $request) {
        if(!isset($request['year']) || $request['year'] == null) {
            $year = date('Y'); // Default
        } else {
            $year = $request['year'];
        }

        $dates = Post::select('created_at')->distinct()->get(); // Getting distinct post dates

        // Retrieving unique years
        $years = $dates->unique(function($date) {
            return $date['created_at']->year;
        })->map(function($date) {
            return $date['created_at']->year;
        })->sort()->toArray();

        // Getting posts sorted by date
        $posts_by_month = Post::whereYear('created_at', '=', $year)->where('is_published', true)->orderBy('created_at', 'asc')->get();

        // Getting months
        $months = $posts_by_month->unique(function($date) {
            return $date['created_at']->month;
        })->map(function($date) {
            return $date['created_at']->month;
        })->sort()->toArray();

        foreach($months as $month) {
            $index = array_search($month, $months);
            $months[$index] = date('F', strtotime("2018-$month-01"));
        }

        $first_month = $months[0];

        $selected_year = $year;

        return view('archives', compact('years', 'posts_by_month', 'months', 'first_month', 'selected_year'));
    }

    public function single($id) {
        $post = Post::find($id);
        $recent_posts = Post::orderBy('created_at', 'desc')->limit(5)->get();
        return view('single', compact('post', 'recent_posts'));
    }

    public function search(Request $request) {
        if(isset($request['search']) && $request['search'] != null) {
            $results = Post::where('author', 'like', '%'.$request['search'].'%')->union(Post::where('title', 'like', '%'.$request['search'].'%'))->union(Post::where('content', 'like', '%'.$request['search'].'%'))->get();
            return view('search_results', compact('results'));
        }
    }

    public function new_post() {
        return view('new_post');
    }

    public function add_post(Request $request) {
        $post = new Post;
        if(isset($request['title'])) {
            $post->title = $request['title'];
            $post->author = $request['author'];
            $post->content = $request['content'];

            if($request['publish'] == 'on') {
                $post->is_published = true;
            } else {
                $post->is_published = false;
            }

            if($request['protected'] == 'on') {
                $post->is_protected = true;
            } else {
                $post->is_protected = false;
            }
            $post->save();
            return redirect()->back()->with('status', true);
        } else {
            return redirect()->back()->with('status', false);
        }
    }

    public function requests() {
        $requests = User::where('is_approved', false)->get();
        return view('requests', compact('requests'));
    }

    public function approve($id) {
        $user = User::find($id);
        $user->is_approved = true;
        $user->save();
        return redirect()->back()->with('status', true);
    }

    public function reject($id) {
        return redirect()->back()->with('status', true);
    }

    public function forbidden() {
        return view('forbidden');
    }

    public function logout() {
        Auth::logout();
        return redirect('/home');
    }
}
