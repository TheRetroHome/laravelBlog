<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Http\Requests\StoreCategory;
class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags=Tag::paginate(2);
        $pagination = $tags->links('pagination::bootstrap-4');
        return view('admin.tags.index',compact('tags','pagination'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategory $request)
    {
        Tag::create($request->validated());
        return redirect()->route('tags.index')->with('success','Тэг успешно добавлен!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tag = Tag::find($id);
        return view('admin.tags.edit')->with('tag',$tag);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategory $request, string $id)
    {
        $request->validated();
        $tag = Tag::find($id);
        //$tags->slug = null;        //Позволит изменить slug специально под title
        $tag->update($request->all());
        return redirect()->route('tags.index')->with('success','Тэг успешно редактирован!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tag::find($id);
        if($tag->posts->count()){
            return redirect()->route('tags.index')->with('error','Ошибка! У тега есть записи');
        }
        $tag->delete();
        return redirect()->route('tags.index')->with('success','Тег успешно удален!');
        //Tag::destroy($id); //Удаление одной строчкой кода
    }

}
