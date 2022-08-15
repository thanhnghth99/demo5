<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;

class CategoryController extends Controller
{
    public function index(Category $categories)
    {
        $categories = $categories->latest()->paginate(5);
        return view('admin.category.category', compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
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
            // 'tag' => 'nullable|array'
        ]);
        $category->create($data);
        // $dataAdded->tags()->sync($data['tag']);

        return redirect('/category');
    }

    public function edit(Category $category)
    {
        $categories = $category->find($category->id);
        return view('admin.category.edit-category',['categories' => $categories]);
    }    

    public function update(Request $request, Category $category)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $data = $request->validate([
            'name' => 'required',
            'status' => 'required',
            // 'tag' => 'nullable|array'
        ]);
        $categories = $category->find($category->id);
        $categories->fill($data)->save();
        return redirect('/category');
    }

    public function destroy(Category $category)
    {
        $categories = $category->delete();
        return redirect('/category');
    } 
    
    public function show()
    {

    }
}
