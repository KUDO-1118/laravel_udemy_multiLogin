<?php
// app/View/Components/Tests/Card.php
namespace App\View\Components\Tests;

use Illuminate\View\Component;

class Card extends Component
{
    public $title;
    public $content;

    public function __construct($title = null, $content = null)
    {
        $this->title = $title;
        $this->content = $content;
    }

    public function render()
    {
        return view('components.tests.card');
    }
}
