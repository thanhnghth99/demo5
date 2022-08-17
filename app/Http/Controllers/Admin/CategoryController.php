<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;

class CategoryController extends Controller
{
    public function index(Category $categories)
    {
        $categories = $categories->latest()->paginate(5);
        return view('admin.category.index', compact('categories'));
    }

    public function create(Tag $tag, Category $category)
    {
        $categories = $category->all();
        $tags = $tag->all();
        return view('admin.category.create-category', ['tags' => $tags]);
    }

    public function store(Request $request, Category $category)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $data = $request->validate([
            'name' => 'required',
            'status' => 'required',
            'tag' => 'nullable|array'
        ]);
        $dataAdd = $category->create($data);
        $dataAdd->tags()->sync($data['tag']);

        return redirect('/category');
    }

    public function edit(Category $category, Tag $tag)
    {
        $categories = $category->find($category->id);
        $tags = $tag->all();
        $dataTags = $category->tags()->get();
        return view('admin.category.edit-category',['categories' => $categories, 'tags' => $tags, 'dataTags' => $dataTags]);
    }    

    public function update(Request $request, Category $category)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $data = $request->validate([
            'name' => 'required',
            'status' => 'required',
            'tag' => 'nullable|array'
        ]);
        $categories = $category->find($category->id);
        $categories->fill($data)->save();
        $categories->tags()->sync($data['tag']);
        return redirect('/category');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect('/category');
    } 
    
    public function show()
    {

    }
}
