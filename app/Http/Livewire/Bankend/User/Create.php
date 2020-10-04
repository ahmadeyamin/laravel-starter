<?php

namespace App\Http\Livewire\Bankend\User;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class Create extends Component
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
    public $status = true;
    public $phone;
    public $roles = [];
    public $role;
    // roleSelectChanged



    protected $listeners = ['roleSelectChanged'];

    public function roleSelectChanged($id = null)
    {
        $this->role = (int) $id;
    }

    public function mount()
    {
        $this->roles = Role::all();
        $this->username = Str::random(10);
    }

    public function updatedName($name)
    {
        $this->username = Str::slug($name);
    }

    public function updatedUserName($username)
    {
        $this->username = Str::slug($username);
    }

    public function updatedAvatar()
    {
        $this->validate([
            'avatar' => 'nullable|image|max:1024'
        ]);
    }

    public function render()
    {
        return view('livewire.bankend.user.create');
    }



    public function save()
    {
        // dd($this->role);
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'username' => 'required|max:20|unique:users,username',
            'avatar' => 'nullable|image|max:1024',
            // 'status' => 'in:1,0',
            'phone' => 'nullable',
            'role' => 'required|exists:roles,id',
        ]);
        // $user = User::find(2);
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'username' => $this->username,
            'status' => $this->status??0,
            'role_id' => $this->role,
        ]);

        if ($this->avatar) {

            $path = $this->avatar->store('profile-photos','public');

            $user->update([
                'profile_photo_path' =>  $path,
            ]);
            // $user
            // ->addMedia($this->avatar->getRealPath())
            // ->preservingOriginal()
            // ->toMediaCollection('avatar');
        }

        session()->flash('success', 'Post successfully updated.');

        return redirect()->to(route('backend.users.index'));
    }
}
