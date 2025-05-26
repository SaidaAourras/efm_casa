<?php

namespace App\View\Components;

use App\Models\Event;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardEvent extends Component
{
    /**
     * Create a new component instance.
     */

    public $event;
    public function __construct(Event $event)
    {
        $this->event = $event;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-event');
    }
}
