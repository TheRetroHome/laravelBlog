<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function show($slug){
        $category = Category::where('slug',$slug)->firstOrFail();
        $posts = $category->posts()->orderBy('id','desc')->paginate(2);
        $pagination = $posts->links('pagination::bootstrap-4');
        return view('categories.show',compact('category','posts','pagination'));
    }
}
