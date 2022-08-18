<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;

class ArticleController extends Controller
{
    public function index(Article $article)
    {
        $articles = $article->with(['authorInfo'])->latest()->paginate(5);
        return view('admin.article.index', compact('articles'));
    }

    public function create(Tag $tag, Article $article, Category $category)
    {
        $article->all();
        $tags = $tag->all();
        $categories = $category->all();
        return view('admin.article.create-article', ['tags' => $tags, 'categories' => $categories]);
    }

    public function store(Request $request, Article $article)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $data = $request->validate([
            'name' => 'required',
            'content' => 'required',
            'image' => 'required',
            'status' => 'required',
            'tag' => 'nullable|array',
            'category' => 'nullable|array',
        ]);

        $fileName = $this->handleFileUpload($request);
        $data['image'] = $fileName;
        $data['author'] = auth()->id();

        $article = Article::create($data);
        $article->tags()->sync($data['tag']);
        $article->categories()->sync($data['category']);
        
        return redirect('/article')
            ->with('success', 'Successfully created.');
    }

    public function handleFileUpload(Request $request){
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $request->file('image')->storeAs('images', $fileName);
            return $fileName;
        }
        return '';
    }

    public function edit(Article $article, Tag $tag, Category $category)
    {
        $articles = $article->find($article->id);
        $tags = $tag->all();
        $categories = $category->all();
        $dataTags = $articles->tags()->get();
        $dataCategories = $articles->categories()->get();

        return view('admin.article.edit-article', ['articles' => $articles, 'tags' => $tags, 'dataTags' => $dataTags, 
                                                   'categories' => $categories, 'dataCategories' => $dataCategories]);
    }

    public function update(Request $request, Article $article)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $data = $request->validate([
            'name' => 'required',
            'content' => 'required',
            'image' => ['nullable', 'file'],
            'status' => 'required',
            'tag' => 'nullable|array',
            'category' => 'nullable|array',
        ]);

        $fileName = $this->handleFileUpload($request);
        
        if(empty($fileName))
        {
            $data['image'] = $article->image;
        } 
        else 
        {
            $data['image'] = $fileName;
        }

        $data['author'] = auth()->id();
        
        $article->fill($data)->save();
        $article->tags()->sync($data['tag']);
        $article->categories()->sync($data['category']);

        return redirect('/article')
            ->with('success', 'Successfully updated.');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect('/article')
            ->with('success', 'Successfully deleted.');
    }

    public function show()
    {

    }
}
