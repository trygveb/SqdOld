<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MemberTable extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
   public $legendTitle;
   public $schedule;
   public $addRemoveTitle;
   public $vMemberSchedules;
   
    public function __construct($legendTitle, $schedule, $addRemoveTitle, $vMemberSchedules)
    {
         $this->legendTitle = $legendTitle;
         $this->schedule = $schedule;
         $this->addRemoveTitle = $addRemoveTitle;
         $this->vMemberSchedules = $vMemberSchedules;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.member-table');
    }
}
