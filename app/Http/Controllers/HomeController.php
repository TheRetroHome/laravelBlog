<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class HomeController extends Controller
{
    public function index(){
        $posts = Post::with('category')->orderBy('id','desc')->paginate(2);
        $pagination = $posts->links('pagination::bootstrap-4');
        return view('posts.index',compact('posts','pagination'));
    }
    public function show($slug){
        $post = Post::where('slug',$slug)->firstOrFail();
        $post->views += 1;
        $post->update();
        return view('posts.show',compact('post'));
    }
}
