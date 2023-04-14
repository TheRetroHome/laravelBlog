<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePost;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MainPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts=Post::with('category','tags')->paginate(5);
        $pagination = $posts->links('pagination::bootstrap-4');
        $colors = [
            'Чёрный' => 'bg-dark',
            'Белый' => 'bg-white text-dark',
            'Красный' => 'bg-danger',
            'Оранжевый' => 'bg-warning',
            'Жёлтый' => 'bg-yellow',
            'Синий' => 'bg-primary',
        ];
        return view('admin.post.index',compact('posts','colors','pagination'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all()->pluck('title','id');
        $tags = Tag::all()->pluck('title','id');
        return view('admin.post.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePost $request)
    {
        $data = $request->validated();
        $data['thumbnail'] = Post::uploadImage($request);

        $post = Post::create($data);
        $post->tags()->sync($request->tags);
        return redirect()->route('post.index')->with('success','Пост успешно добавлена!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();
        return view('admin.post.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePost $request, string $id)
    {
        $request->validated();
        $post = Post::find($id);
        $data = $request->all();
        if($file = Post::uploadImage($request,$post->thumbnail)){
            $data['thumbnail'] = $file;
        }
        $post->update($data);
        $post->tags()->sync($request->input('tags')); // Сохранение связанных тегов

        return redirect()->route('post.index')->with('success', 'Пост успешно обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        $post->tags()->sync([]);
        if($post->thumbnail){
            Storage::delete($post->thumbnail);
        }
        $post->delete();
        //Post::destroy($id); //Удаление одной строчкой кода
        return redirect()->route('post.index')->with('success','Пост успешно удалена!');
    }
}
