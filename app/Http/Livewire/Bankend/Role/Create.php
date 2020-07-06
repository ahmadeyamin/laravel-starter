<?php

namespace App\Http\Livewire\Bankend\Role;

use App\Models\Role;
use Livewire\Component;
use Illuminate\Support\Str;

class Create extends Component
{
    public $selectedRole ;
    public $name;
    public $slug;
    public $description;
    public $roles;
    public $approle;


    public function mount()
    {

        $this->roles = Role::getAllRoles();
        $this->selectedRole = 'select';
    }

    public function updatedName()
    {
        $this->validate([
            'name' => 'required|min:3|unique:roles,name',
        ]);
        $this->slug = Str::slug($this->name);
    }

    public function selecteRoleselected()
    {
        if($this->selectedRole == 'select'){
            $this->selectedRole = null;
            $this->emit('roleSelectChanged',null);
        }else{
            $this->selectedRole = 'select';
        }
    }

    public function selecteRolesEmpty()
    {
        $this->selectedRole = null;
        $this->emit('roleSelectChanged',null);
    }


    public function render()
    {
        return view('livewire.bankend.role.create');
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|min:3|unique:roles,name',
            'slug' => 'required|unique:roles,slug',
            'description' => 'nullable',
        ]);

        $role  = Role::create([
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
    }
}
