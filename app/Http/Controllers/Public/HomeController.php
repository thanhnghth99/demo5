<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::where('status', Article::STATUS_ENABLE)->latest()->limit(4)->get();

        return view('pages.content', compact('articles'));
    }

    public function category($id)
    {
        $category = Category::find($id);

        $dataArticles = $category->articles()->where('status', Article::STATUS_ENABLE)->get();
        $dataTags = $category->tags()->get();

        return view('pages.category', compact('category', 'dataArticles', 'dataTags'));
    }
    
    public function tag($id)
    {
        $tag = Tag::find($id);
        
        $dataCategories = $tag->categories->first();
        $dataArticles = $tag->articles()->where('status', Article::STATUS_ENABLE)->get();
        
        return view('pages.tag', compact('tag', 'dataArticles', 'dataCategories'));
    }

    public function single($id)
    {
        $article = Article::find($id);
        
        $dataTags = $article->tags()->get();
        
        return view('pages.single', compact('article', 'dataTags'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function search(ArticleService $articleService, Request $request)
    {
        $filter = $request->query();
        
        $dataArticles = $articleService->getList($filter);
        
        return view('pages.search', compact('dataArticles'))->with('searchKeyword', $filter['search'] ?? '');
    }
}
