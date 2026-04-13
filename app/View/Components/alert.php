<?php

namespace App\View\Components;

use Illuminate\View\Component;
use PhpParser\Node\Expr\FuncCall;

class alert extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $type;
    public $message;
    public $dismiss;
    public $userId;

    protected $types = ['danger', 'success', 'info'];

    // with slot
    public function __construct($type="", $dismiss=false, $userId = 1)
    {
        $this->type = $type;
        $this->dismiss = $dismiss;
        $this->userId = $userId;
    }

    public function link(){
        
    }

    // without slot
    /* public function __construct($type="", $message="", $dismiss=false)
    {
        $this->type = $type;
        $this->message = $message;
        $this->dismiss = $dismiss;
    } */

    public Function valid_type(){
        return in_array($this->type, $this->types) ? $this->type : "danger"; 
    }

    public Function formatAlert(string $data){
        return $data; 
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert');
        // return '<div >{{ $userId }}Components content</div>';
    }
}
