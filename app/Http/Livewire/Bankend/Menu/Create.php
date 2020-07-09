<?php

namespace App\Http\Livewire\Bankend\Menu;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Backend\Menu;

class Create extends Component
{
    public $name,$description;


    public function render()
    {
        return view('livewire.bankend.menu.create');
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|min:3|unique:menus,name'
        ]);

        Menu::create([
            'name' => $this->name,
            'description' => $this->description,
            'slug' => Str::slug($this->name),
        ]);

        $this->name = '';
        $this->description = '';

        $this->dispatchBrowserEvent('notify',[
            'type' => 'Success',
            'message' =>'Menu Created successfully.',
            'reload' => true,
        ]);
    }
}
