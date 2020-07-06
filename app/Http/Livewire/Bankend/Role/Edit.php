<?php

namespace App\Http\Livewire\Bankend\Role;

use App\Models\Role;
use Livewire\Component;
use Illuminate\Support\Str;

class Edit extends Component
{
    public $selectedRole ;
    public $name;
    public $roleid;
    public $slug;
    public $description;
    public $roles;
    public $approle;


    /**
     * mount
     *
     * @param  mixed $id
     * @return void
     */
    public function mount($id)
    {

        $this->roles = Role::getAllRoles();
        $this->selectedRole = Role::find($id);
        $this->name = $this->selectedRole->name;
        $this->roleid = $this->selectedRole->id;
        $this->slug = $this->selectedRole->slug;
        $this->description = $this->selectedRole->description;
    }


    /**
     * updatedName
     *
     * @return void
     */
    public function updatedName()
    {
        $this->validate([
            'name' => 'required|min:3|unique:roles,name',
        ]);
        $this->slug = Str::slug($this->name);
    }

    /**
     * selecteRoleselected
     *
     * @return void
     */
    public function selecteRoleselected()
    {
        if($this->selectedRole == 'select'){
            $this->selectedRole = null;
            $this->emit('roleSelectChanged',null);
        }else{
            $this->selectedRole = 'select';
        }
    }

    /**
     * selecteRolesEmpty
     *
     * @return void
     */
    public function selecteRolesEmpty()
    {
        $this->selectedRole = null;
        $this->emit('roleSelectChanged',null);
    }


    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.bankend.role.edit');
    }

    /**
     * save
     *
     * @return void
     */
    public function save()
    {
        $role = Role::findOrFail($this->roleid);

        $this->validate([
            'name' => 'required|min:3|unique:roles,name,'.$role->id,
            'slug' => 'required|unique:roles,slug,'.$role->id,
            'description' => 'nullable',
        ]);

        $role->update([
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
        ]);


        $this->name = '';
        $this->slug = '';
        $this->description = '';

        $this->roles = Role::getAllRoles();
        $this->approle = $role->id;
        $this->emit('roleSelectChanged',$this->approle);


        $this->selectedRole = 'select';

        $this->dispatchBrowserEvent('notify',[
            'type' => 'Success',
            'message' =>'Role Updated successfully.',
        ]);
    }


    /**
     * delete
     *
     * @return void
     */
    public function delete()
    {
        $role = Role::findOrFail($this->roleid);

        if ($role->deletable) {
            return $this->dispatchBrowserEvent('notify',[
                'type' => 'Error',
                'message' =>'This Role Is Not Deletable',
            ]);
        }

        if ($role->users->count() > 0) {
            return $this->dispatchBrowserEvent('notify',[
                'type' => 'Error',
                'message' =>'This Role has Some Users Please Remove Users First.',
            ]);
        }else{

            $role->delete();


            session()->flash('success', 'Role Deleted successfully.');

            return redirect()->to(route('backend.roles.index'));
        }
    }
}
