<?php

namespace App\View\Components;

use Illuminate\View\Component;

class scheduleAdminMenu extends Component
{
      public $scheduleId;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($scheduleId)
    {
        $this->scheduleId= $scheduleId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.schedule-admin-menu');
    }
}
