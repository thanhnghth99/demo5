<?php

namespace App\View\Components\Pages;

use Illuminate\View\Component;

class DataArticle extends Component
{
    public $items;
    public $id;
    public $name;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $items = [],
        $id = null,
        $name = null,
    ) {
        $this->items = $items;
        $this->id = $id;
        $this->name = $name;
    }
    
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pages.data-article');
    }
}
