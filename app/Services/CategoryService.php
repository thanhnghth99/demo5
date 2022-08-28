<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryService
{
    public function getList(array $filter = [])
    {
        $category = new Category;
        $categoryTable = $category->getTable();
        $query = $category
            ->select("{$categoryTable}.*")
            ->search($filter, ['categories.name']);
        
        return $query->paginate(10)->withQueryString();
    }

    public function create($data)
    {
        DB::beginTransaction();
        try {
            $category = Category::create($data);
            $category->tags()->sync(Arr::get($data, 'tag', []));

            DB::commit();

            return $category;
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error($err->getMessage());

            return null;
        }
    }

    public function update($data, Category $category)
    {
        DB::beginTransaction();
        try {
            $category->fill($data)->save();
            $category->tags()->sync(Arr::get($data, 'tag', []));

            DB::commit();

            return $category;
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error($err->getMessage());

            return null;
        }
    }

    public function delete(Category $category)
    {
        $category->articles()->detach();
        $category->tags()->detach();
        $category->delete();
    }
}