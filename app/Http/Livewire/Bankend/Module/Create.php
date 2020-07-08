<?php

namespace App\Http\Livewire\Bankend\Module;

use App\Models\Module;
use Livewire\Component;

class Create extends Component
{
    public $name;

    public function render()
    {
        return view('livewire.bankend.module.create');
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|min:3'
        ]);

        Module::create([
            'name' => $this->name,
        ]);

        $this->name = '';

        $this->dispatchBrowserEvent('notify',[
            'type' => 'Success',
            'message' =>'Module Created successfully.',
            'reload' => true,
        ]);
    }
}
