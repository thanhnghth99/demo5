<?php

namespace App\Services;

use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TagService
{
    public function getList(array $filter = [])
    {
        $tag = new Tag;
        $tagTable = $tag->getTable();
        $query = $tag
            ->select("{$tagTable}.*")
            ->search($filter, ['tags.name']);
        
        return $query->orderBy('name')->getPaginate($filter);
    }

    public function create($data)
    {
        DB::beginTransaction();
        try {
            $tag = Tag::create($data);

            DB::commit();

            return $tag;
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error($err->getMessage());

            return null;
        }
    }

    public function update($data, Tag $tag)
    {
        DB::beginTransaction();
        try {
            $tag->fill($data)->save();

            DB::commit();

            return $tag;
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error($err->getMessage());

            return null;
        }        
    }

    public function delete(Tag $tag)
    {
        $tag->articles()->detach();
        $tag->categories()->detach();
        $tag->delete();
    }
}
