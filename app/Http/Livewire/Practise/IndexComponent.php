<?php

namespace App\Http\Livewire\Practise;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class IndexComponent extends Component
{
    use LivewireAlert;
    public $is_single_page=0,$is_mcq=1, $q_range="1-25", $q_number=10, $q_time=30, $is_minus=0;

    public function mount()
    {
        if (session()->has('q_range')){
            $this->q_range = session()->get('q_range');
        }
        if (session()->has('q_number')){
            $this->q_number = session()->get('q_number');
        }
        session()->has('is_single_page')? $this->is_single_page = session()->get('is_single_page'):'';
        session()->has('q_time')? $this->q_time = session()->get('q_time'):'';
        session()->has('is_minus')? $this->is_minus = session()->get('is_minus'):'';
        session()->has('is_mcq')? $this->is_mcq = session()->get('is_mcq'):'';
        $this->startPractise();
    }
    public function updated($f, $v)
    {
        $parts = explode('-', $this->q_range);
        $range = $parts[1]-$parts[0]+1;
        if ($f=='q_number' || $f=='q_range'){
            if ($this->q_number>$range){
                $this->q_number = 20;
                $this->alert('error', __('Question number must be less than range'));
            }
        }
        $this->startPractise();
    }
     public function startPractise()
    {
        session()->put(['is_single_page'=> $this->is_single_page, 'q_range' => $this->q_range, 'q_number' => $this->q_number, 'q_time'=>$this->q_time, 'is_minus'=>$this->is_minus, 'is_mcq'=>$this->is_mcq]);
        $this->alert('success', __('Successfully saved'));
    }
    public function render()
    {
        return view('livewire.practise.index-component');
    }
}
