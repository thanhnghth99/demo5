<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ArticleService
{
    public function getList(array $filter = [])
    {
        $article = new Article;
        $articleTable = $article->getTable();
        $query = $article->join('users', 'users.id', '=', "{$articleTable}.author")
            ->select("{$articleTable}.*")
            ->search($filter, ['articles.name', 'users.name']);
        
        return $query->paginate(10)->withQueryString();
    }

    public function create($data)
    {
        DB::beginTransaction();
        try {
            $fileName = $this->handleFileUpload(Arr::get($data, 'image'));
            $data['image'] = $fileName;
            $data['author'] = auth()->id();
    
            $article = Article::create($data);
            // $article->tags()->sync($data['tag']);
            // $article->categories()->sync($data['category']);
            $article->tags()->sync(Arr::get($data, 'tag', []));
            $article->categories()->sync(Arr::get($data, 'category', []));

            DB::commit();

            return $article;
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error($err->getMessage());

            return null;
        }
    }

    public function update($data, Article $article)
    {
        DB::beginTransaction();
        try {
            $fileName = $this->handleFileUpload(Arr::get($data, 'image'));
        
            if(empty($fileName))
            {
                $data['image'] = $article->image;
            } 
            else 
            {
                $filePath = public_path('images/' .$article->image);
                if(File::exists($filePath))
                {
                    unlink($filePath);
                }
                $data['image'] = $fileName;
            }

            $data['author'] = auth()->id();
            
            $article->fill($data)->save();
            // $article->tags()->sync($data['tag']);
            // $article->categories()->sync($data['category']);
            $article->tags()->sync(Arr::get($data, 'tag', []));
            $article->categories()->sync(Arr::get($data, 'category', []));

            DB::commit();

            return $article;
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error($err->getMessage());

            return null;
        }        
    }

    public function delete(Article $article)
    {
        $article->tags()->detach();
        $article->categories()->detach();
        $article->delete();
    }

    public function handleFileUpload(?UploadedFile $file){
        if(is_null($file))
        {
            return null;
        }
            $fileName = date('Y-m-d_H-i-s') . '_' . $file->getClientOriginalName();
            $file->storeAs('images', $fileName);
            return $fileName;
            
    }
}
