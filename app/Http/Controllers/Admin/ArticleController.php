<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Tag;

class ArticleController extends Controller
{
    public function index(Article $articles)
    {
        $articles = $articles->latest()->paginate(5);
        return view('admin.article.index', compact('articles'));
    }

    public function create(Tag $tag, Article $article)
    {
        $articles = $article->all();
        $tags = $tag->all();
        return view('admin.article.create-article', ['articles' => $articles, 'tags' => $tags]);
    }

    public function store(Request $request, Article $article)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $data = $request->validate([
            'name' => 'required',
            'author' => 'required',
            'content' => 'required',
            'image' => 'required',
            'status' => 'required',
            'tag' => 'nullable|array'
        ]);

        $fileName = $this->handleFileUpload($request);
        $data['image'] = $fileName;

        $dataAdd = $article->create($data);
        $dataAdd->tags()->sync($data['tag']);
        
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

    public function edit(Article $article, Tag $tag)
    {
        $articles = $article->find($article->id);
        $tags = $tag->all();
        $dataTags = $articles->tags()->get();

        return view('admin.article.edit-article', ['articles' => $articles, 'tags' => $tags, 'dataTags' => $dataTags]);
    }

    public function update(Request $request, Article $article)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $data = $request->validate([
            'name' => 'required',
            'author' => 'required',
            'content' => 'required',
            'image' => ['nullable', 'file'],
            'status' => 'required',
            'tag' => 'nullable|array',
        ]);

        $fileName = $this->handleFileUpload($request);
        $articles = $article->find($article->id);
        
        if(empty($fileName))
        {
            $data['image'] = $articles->image;
        } 
        else 
        {
            $data['image'] = $fileName;
        }

        $articles->fill($data)->save();
        $articles->tags()->sync($data['tag']);

        return redirect('/article')
            ->with('success', 'Successfully updated.');
    }

    public function destroy(Article $article)
    {
        $articles = $article->delete();
        return redirect('/article')
            ->with('success', 'Successfully deleted.');
    }

    public function show()
    {

    }
}
