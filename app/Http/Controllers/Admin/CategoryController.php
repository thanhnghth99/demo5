<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Tag;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(CategoryService $categoryService, Request $request)
    {
        $filter = $request->query();
        $categories = $categoryService->getList($filter);
        return view('admin.category.index', compact('categories'));
    }

    public function create(Tag $tag, Category $category)
    {
        $category->all();
        $tags = $tag->all();
        return view('admin.category.create-category', ['tags' => $tags]);
    }

    public function store(StoreCategoryRequest $request, CategoryService $categoryService)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $category = $categoryService->create($request->validated());
        if(is_null($category))
        {
            return back()->with('error', 'Failed create.');
        }

        return redirect('/category')
            ->with('success', 'Successfully created.');
    }

    public function edit(Category $category, Tag $tag)
    {
        $categories = $category->find($category->id);
        $tags = $tag->all();
        $dataTags = $categories->tags->pluck('id')->toArray();
        return view('admin.category.edit-category',['categories' => $categories, 'tags' => $tags, 'dataTags' => $dataTags]);
    }    

    public function update(UpdateCategoryRequest $request, Category $category, CategoryService $categoryService)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $categoryService->update($request->validated(), $category);

        return redirect('/category')
            ->with('success', 'Successfully updated.');
    }

    public function destroy(Category $category, CategoryService $categoryService)
    {
        $categoryService->delete($category);
        return redirect('/category')
            ->with('success', 'Successfully deleted.');
    } 
    
    public function show()
    {

    }
}