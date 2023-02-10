<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RegistrationForm extends Component
{
   public $isAdmin;
   public $names;
   public $scheduleId;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($names, $scheduleId, $isAdmin)
    {
        $this->names= $names;
        $this->scheduleId= $scheduleId;
        $this->isAdmin= $isAdmin;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.registration-form');
    }
}
