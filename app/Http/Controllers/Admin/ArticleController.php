<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Services\ArticleService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    public function index(ArticleService $articleService, Request $request)
    {
        if(auth()->user()->usertype)
        {
            $filter = [
                ...$request->query(),
                'paginate' => 10,
            ];
        }
        else
        {
            $filter = [
                ...$request->query(),
                'paginate' => 10,
                'filter' => [
                    ...$request->query('filter', []),
                    'author' => auth()->id(),
                ]
            ];
        }
        $articles = $articleService->getList($filter);
        return view('admin.article.index', compact('articles'));
    }

    public function create(Tag $tag, Article $article, Category $category)
    {
        $article->all();
        $tags = $tag->all();
        $categories = $category->all();
        return view('admin.article.create-article', ['tags' => $tags, 'categories' => $categories]);
    }

    public function store(StoreArticleRequest $request, ArticleService $articleService)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $article = $articleService->create($request->validated());
        if(is_null($article))
        {
            return back()->with('error', 'Failed create.');
        }
        
        return redirect('/article')
            ->with('success', 'Successfully created.');
    }

    public function edit(Article $article, Tag $tag, Category $category)
    {
        $articles = $article->find($article->id);
        $tags = $tag->all();
        $categories = $category->all();
        $dataTags = $articles->tags->pluck('id')->toArray();
        $dataCategories = $articles->categories->pluck('id')->toArray();

        return view('admin.article.edit-article', ['articles' => $articles, 'tags' => $tags, 'dataTags' => $dataTags, 
                                                   'categories' => $categories, 'dataCategories' => $dataCategories]);
    }

    public function update(UpdateArticleRequest $request, Article $article, ArticleService $articleService)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $articleService->update($request->validated(), $article);

        return redirect('/article')
            ->with('success', 'Successfully updated.');
    }

    public function destroy(Article $article, ArticleService $articleService)
    {
        $articleService->delete($article);
        return redirect('/article')
            ->with('success', 'Successfully deleted.');
    }

    public function show()
    {

    }
}
