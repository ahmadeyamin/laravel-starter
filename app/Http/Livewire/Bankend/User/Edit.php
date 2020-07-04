<?php

namespace App\Http\Livewire\Bankend\User;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;

class Edit extends Component
{
    use WithFileUploads;

    public $username;
    public $name;
    public $location;
    public $website;
    public $bio;
    public $email;
    public $password;
    public $avatar;
    public $avatarNew;
    public $status;
    public $phone;
    public $roles = [];
    public $role;


    public $user;

    public function mount($user)
    {
        $this->user = $user;
        $this->roles = Role::all();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->bio = $user->bio;
        $this->avatar = $user->avatar;
        $this->username = $user->username;
        $this->role = $user->role_id;
        $this->status = $user->status;
    }

    public function updatedAvatar()
    {
        $this->validate([
            'avatarNew' => 'nullable|image|max:1024'
        ]);
    }

    public function updatedUserName($username)
    {
        $this->username = Str::slug($username);
    }


    public function render()
    {
        return view('livewire.bankend.user.edit');
    }



    public function update()
    {
        $this->validate([
            'name' => 'required|min:6',
            'email' => 'required|email|unique:users,email,'.$this->user->id,
            'password' => 'nullable|min:8',
            'username' => 'required|max:20|unique:users,username,'.$this->user->id,
            'avatarNew' => 'nullable|image|max:1024',
            // 'status' => 'in:1,0',
            'phone' => 'nullable',
            'role' => 'required|in:1,2',
        ]);

        $user = User::findOrFail($this->user->id);

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password ? Hash::make($this->password) : $user->password,
            'username' => $this->username,
            'status' => $this->status??0,
            'role_id' => $this->role,
        ]);

        if ($this->avatarNew) {
            $user
            ->addMedia($this->avatarNew->getRealPath())
            ->preservingOriginal()
            ->toMediaCollection('avatar');
        }

        session()->flash('success', 'User successfully updated.');

        return redirect()->to(route('backend.users.index'));
    }
}
