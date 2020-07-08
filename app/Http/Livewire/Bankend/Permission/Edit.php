<?php

namespace App\Http\Livewire\Bankend\Permission;

use App\Models\Module;
use Livewire\Component;
use App\Models\Permission;

class Edit extends Component
{
    public function render()
    {
        return view('livewire.bankend.permission.edit');
    }

    public $name,$slug,$module;
    public $modules = [];
    public $selectedpermission;


    protected $listeners = ['moduleEditSelectChanged','editpermission'];


    public function moduleEditSelectChanged($id)
    {
        // dd($id);
        $this->module = $id;
    }

    public function editpermission($id)
    {
        $permission = Permission::findOrFail($id);
        // dd($permission);
        $this->selectedpermission = $permission->id;

        $this->name = $permission->name;
        $this->slug = $permission->slug;
        $this->module = $permission->module_id;
    }

    public function mount()
    {
        $this->modules = Module::latest('id')->get();
    }

    public function update()
    {

        $permission = Permission::findOrFail($this->selectedpermission);
        $this->validate([
            'name' => 'required|min:3',
            'slug' => 'required|min:3|unique:permissions,slug,'.$permission->id,
            'module' => 'required|exists:modules,id',
        ]);


        $permission->update([
            'name' => $this->name,
            'slug' => $this->slug,
            'module_id' => $this->module,
        ]);

        $this->name = '';
        $this->slug = '';
        $this->module = null;

        $this->dispatchBrowserEvent('notify',[
            'type' => 'Success',
            'message' =>'Permission Updated successfully.',
            'reload' => true,
        ]);
    }

    public function delete()
    {
        $permission = Permission::findOrFail($this->selectedpermission);

        if ($permission->roles()->count() > 0) {
            return $this->dispatchBrowserEvent('notify',[
                'type' => 'Error',
                'message' =>'This Permission Cunnectd With Some Role Remove First',
                'reload' => false,
            ]);
        }else{
            $permission->delete();
        }



        session()->flash('success', 'Role Deleted successfully.');

        return redirect()->to(route('backend.permissions.index'));

    }
}
