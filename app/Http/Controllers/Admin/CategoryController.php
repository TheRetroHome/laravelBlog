<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategory;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::paginate(2);
        $pagination = $categories->links('pagination::bootstrap-4');
        return view('admin.categories.index',compact('categories','pagination'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategory $request)
    {
        Category::create($request->validated());
        return redirect()->route('categories.index')->with('success','Категория успешно добавлена!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit')->with('category',$category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategory $request, string $id)
    {
    $request->validated();
    $category = Category::find($id);
    //$category->slug = null;        //Позволит изменить slug специально под title
    $category->update($request->all());
        return redirect()->route('categories.index')->with('success','Категория успешно редактирована!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if($category->posts->count()){
            return redirect()->route('categories.index')->with('error','Ошибка! У категории есть записи');
        }
        $category->delete();
        return redirect()->route('categories.index')->with('success','Категория успешно удалена!');
        //Category::destroy($id); //Удаление одной строчкой кода

    }

}
