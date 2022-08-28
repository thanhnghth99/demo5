<?php

namespace App\View\Components\Pages;

use App\Models\Article;
use Illuminate\View\Component;

class NewsSlider extends Component
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

    public function getArticle()
    {
        return Article::where('status', Article::STATUS_ENABLE)->latest()->limit(4)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pages.news-slider');
    }
}
