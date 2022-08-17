<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag;

class TagController extends Controller
{
    public function index(Tag $tags)
    {
        $tags = $tags->latest()->paginate(5);
        return view('admin.tag.index', compact('tags'));
    }

    public function create(Tag $tag)
    {
        $tags = $tag->all();
        return view('admin.tag.create-tag', ['tags' => $tags]);
    }

    public function store(Request $request, Tag $tag)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $data = $request->validate([
            'name' => 'required',
            'status' => 'required',
            // 'tag' => 'nullable|array'
        ]);
        $tag->create($data);
        return redirect('/tag');
    }

    public function edit(Tag $tag)
    {
        $tags = $tag->find($tag->id);
        return view('admin.tag.edit-tag',['tags' => $tags]);
    }    

    public function update(Request $request, Tag $tag)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $data = $request->validate([
            'name' => 'required',
            'status' => 'required',
            // 'tag' => 'nullable|array'
        ]);
        $tags = $tag->find($tag->id);
        $tags->fill($data)->save();
        return redirect('/tag');
    }

    public function destroy(Tag $tag)
    {
        $tags = $tag->delete();
        return redirect('/tag');
    } 
    
    public function show()
    {

    }
}
