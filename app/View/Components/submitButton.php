<?php

namespace App\View\Components;

use Illuminate\View\Component;

class submitButton extends Component
{
   public $submitText;
   public $cancelText;
   public $cancelUrl;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($submitText, $cancelText, $cancelUrl)
    {
         $this->submitText = $submitText;
         $this->cancelText= $cancelText;
         $this->cancelUrl= $cancelUrl;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.submit-button');
    }
}
