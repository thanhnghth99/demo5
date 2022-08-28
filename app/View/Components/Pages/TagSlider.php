<?php

namespace App\View\Components\Pages;

use App\Models\Tag;
use Illuminate\View\Component;

class TagSlider extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getTag()
    {
        return Tag::latest()->limit(10)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pages.tag-slider');
    }
}
