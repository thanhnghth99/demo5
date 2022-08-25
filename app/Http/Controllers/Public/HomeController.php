<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->limit(4)->get();
        $tags = Tag::latest()->limit(10)->get();
        $categories = Category::orderBy('name')->get();

        return view('pages.content', compact('articles', 'tags', 'categories'));
    }

    public function category($id)
    {
        $category = Category::find($id);

        $dataArticles = $category->articles()->get();
        $dataTags = $category->tags()->get();

        $articles = Article::latest()->limit(4)->get();
        $tags = Tag::latest()->limit(10)->get();
        $categories = Category::orderBy('name')->get();

        return view('pages.category', compact('articles', 'tags', 'categories', 'category', 'dataArticles', 'dataTags'));
    }
    
    public function tag($id)
    {
        $tag = Tag::find($id);
        
        $dataArticles = $tag->articles()->get();
        
        $articles = Article::latest()->limit(4)->get();
        $tags = Tag::latest()->limit(10)->get();
        $categories = Category::orderBy('name')->get();

        return view('pages.tag', compact('dataArticles', 'tag', 'articles', 'tags', 'categories'));
    }

    public function single($id)
    {
        $article = Article::find($id);
        
        $dataTags = $article->tags()->get();
        
        $articles = Article::latest()->limit(4)->get();
        $tags = Tag::latest()->limit(10)->get();
        $categories = Category::orderBy('name')->get();

        return view('pages.single', compact('article', 'articles', 'tags', 'categories', 'dataTags'));
    }

    public function contact()
    {
        $articles = Article::latest()->limit(4)->get();
        $categories = Category::orderBy('name')->get();
        
        return view('pages.contact', compact('articles', 'categories'));
    }
}
