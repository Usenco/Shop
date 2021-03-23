<?php

namespace App\View\Components;

use App\Banner;
use Illuminate\View\Component;

class item extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title;
    public $mainimg;
    public $price;
    public $description;
    public $reviews;
    public $mark;
    public function __construct($product)
    {
        $this->title = $product->title;
        $this->mainimg = $product->mainimg;
        $this->price = $product->price;
        $this->description = $product->description;
        $this->reviews = $product->reviews;
        $this->mark = $product->mark;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $title = $this->title;
        $mainimg = $this->mainimg;
        $price = $this->price;
        $reviews = $this->reviews;
        $description = $this->description;
        $mark = $this->mark;

        return view('components.item',compact(
        'title',
        'mainimg',
        'price',
        'reviews',
        'description',
        'mark'));
    }
}
