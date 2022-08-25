<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag;

class TagController extends Controller
{
    public function index(Tag $tags)
    {
        $tags = $tags->paginate(10);
        return view('admin.tag.index', compact('tags'));
    }

    public function create(Tag $tag)
    {
        $tag->all();
        return view('admin.tag.create-tag');
    }

    public function store(Request $request)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $data = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        Tag::create($data);
        return redirect('/tag')
            ->with('success', 'Successfully created.');
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
        ]);

        $tag->fill($data)->save();
        return redirect('/tag')
            ->with('success', 'Successfully updated.');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect('/tag')
            ->with('success', 'Successfully deleted.');
    } 
    
    public function show()
    {

    }
}
