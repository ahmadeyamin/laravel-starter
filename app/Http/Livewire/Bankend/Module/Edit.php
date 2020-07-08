<?php

namespace App\Http\Livewire\Bankend\Module;

use App\Models\Module;
use Livewire\Component;

class Edit extends Component
{
    public $name;
    public $module;
    protected $listeners = ['editmodule'];

    public function editmodule($id)
    {
        $module = Module::findOrFail($id);
        $this->module = $module->id;
        $this->name = $module->name;
    }

    public function mount()
    {

    }

    public function render()
    {
        return view('livewire.bankend.module.edit');
    }


    public function update()
    {
        $this->validate([
            'name' => 'required|min:3'
        ]);

        $module = Module::findOrFail($this->module);

        $module->update([
            'name' => $this->name,
        ]);

        $this->name = '';

        $this->dispatchBrowserEvent('notify',[
            'type' => 'Success',
            'message' =>'Module Updated successfully.',
            'reload' => true,
        ]);
    }

    public function delete()
    {
        $module = Module::findOrFail($this->module);

        if ($module->permissions()->count() > 0) {
            return $this->dispatchBrowserEvent('notify',[
                'type' => 'Error',
                'message' =>'This module Cunnectd With Some Permissions Remove Them First',
                'reload' => false,
            ]);
        }else{
            $module->delete();
        }

        session()->flash('success', 'Role module successfully.');

        return redirect()->to(route('backend.permissions.index'));
    }
}
