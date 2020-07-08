<?php

namespace App\Http\Livewire\Bankend\Permission;

use App\Models\Module;
use App\Models\Permission;
use Livewire\Component;

class Create extends Component
{
    public $name,$slug,$module;
    public $modules = [];


    protected $listeners = ['moduleSelectChanged'];


    public function moduleSelectChanged($id)
    {
        $this->module = $id;
    }

    public function mount()
    {
        $this->modules = Module::latest('id')->get();
    }

    public function render()
    {

        return view('livewire.bankend.permission.create');

    }

    public function save()
    {
        $this->validate([
            'name' => 'required|min:3',
            'slug' => 'required|min:3|unique:permissions,slug',
            'module' => 'required|exists:modules,id',
        ]);
        // dd(request()->all());
        Permission::create([
            'name' => $this->name,
            'slug' => $this->slug,
            'module_id' => $this->module,
        ]);

        $this->name = '';
        $this->slug = '';
        $this->module = null;

        $this->dispatchBrowserEvent('notify',[
            'type' => 'Success',
            'message' =>'Permission Created successfully.',
            'reload' => true,
        ]);
    }
}
