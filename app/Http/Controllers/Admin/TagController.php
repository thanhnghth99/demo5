<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use App\Services\TagService;

class TagController extends Controller
{
    public function index(TagService $tagService, Request $request)
    {
        $filter = $request->query();
        $tags = $tagService->getList($filter);
        return view('admin.tag.index', compact('tags'));
    }

    public function create(Tag $tag)
    {
        $tag->all();
        return view('admin.tag.create-tag');
    }

    public function store(StoreTagRequest $request, TagService $tagService)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $tag = $tagService->create($request->validated());
        if(is_null($tag))
        {
            return back()->with('error', 'Failed create.');
        }
        
        return redirect('/tag')
            ->with('success', 'Successfully created.');
    }

    public function edit(Tag $tag)
    {
        $tags = $tag->find($tag->id);
        return view('admin.tag.edit-tag',['tags' => $tags]);
    }    

    public function update(UpdateTagRequest $request, Tag $tag, TagService $tagService)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $tagService->update($request->validated(), $tag);

        return redirect('/tag')
            ->with('success', 'Successfully updated.');
    }

    public function destroy(Tag $tag, TagService $tagService)
    {
        $tagService->delete($tag);
        return redirect('/tag')
            ->with('success', 'Successfully deleted.');
    } 
    
    public function show()
    {

    }
}
