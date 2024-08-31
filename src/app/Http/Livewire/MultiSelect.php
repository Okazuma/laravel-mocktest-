<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

class MultiSelect extends Component
{

    public $options = [];
    public $selectedOptions = [];
    public $showCategoryList = false;

    public function mount()
    {
        $this->options = Category::pluck('category', 'id')->toArray();
    }


    public function toggleCategoryList()
    {
        $this->showCategoryList = !$this->showCategoryList;
    }


    public function toggleSelection($id)
    {
        if (in_array($id, $this->selectedOptions)) {
            $this->selectedOptions = array_diff($this->selectedOptions, [$id]);
        } else {
            $this->selectedOptions[] = $id;
        }
    }


    public function removeSelection($id)
    {
        $this->selectedOptions = array_diff($this->selectedOptions, [$id]);
    }


    public function render()
    {
        return view('livewire.multi-select');
    }
}
