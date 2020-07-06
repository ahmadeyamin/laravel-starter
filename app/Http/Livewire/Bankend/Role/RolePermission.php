<?php

namespace App\Http\Livewire\Bankend\Role;

use App\Models\Role;
use App\Models\Module;
use Livewire\Component;
use App\Models\Permission;
use Debugbar;

class RolePermission extends Component
{
    public $modules = [];
    public $roleId;
    public $apppermission = [

    ];

    protected $listeners = ['roleSelectChanged'];


    /**
     * roleSelectChanged
     *
     * @param  mixed $id
     * @return void
     */
    public function roleSelectChanged($id = null)
    {
        $this->roleId = (int) $id;

        if ($this->roleId != 0) {
            $this->modules = Module::getAllModules();
            $this->apppermission = Role::with('permissions')->find($this->roleId)->permissions->pluck('id','id')->toArray();
        }else{
            $this->modules = [];
            $this->apppermission = [];
        }


    }

    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.bankend.role.role-permission');
    }



    /**
     * save
     *
     * @return void
     */
    public function save()
    {
        $data = collect($this->apppermission)->filter();

        Role::find($this->roleId)->permissions()->sync($data);

        $this->dispatchBrowserEvent('notify',[
            'type' => 'Success',
            'message' =>'Role Premissions successfully updated.',
        ]);
    }
}
