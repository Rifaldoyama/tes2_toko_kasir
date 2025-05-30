<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Layout extends Component
{
    public $title;

    public function __construct($title = 'My App')
    {
        $this->title = $title;
    }

    public function render()
    {
        return view('components.layout');
    }
}
