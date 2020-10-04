<?php

namespace App\Http\Livewire\Bankend\User;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
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


    protected $listeners = ['roleSelectChanged'];

    public function roleSelectChanged($id = null)
    {
        $this->role = (int) $id;
    }

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
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,'.$this->user->id,
            'password' => 'nullable|min:8',
            'username' => 'required|max:20|unique:users,username,'.$this->user->id,
            'avatarNew' => 'nullable|image|max:1024',
            // 'status' => 'in:1,0',
            'phone' => 'nullable',
            'role' => 'required|exists:roles,id',
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

        // if ($this->avatarNew) {
        //     $user
        //     ->addMedia($this->avatarNew->getRealPath())
        //     ->preservingOriginal()
        //     ->toMediaCollection('avatar');
        // }

        if ($this->avatarNew) {
            
            $path = $this->avatarNew->store('profile-photos','public');

            $user->update([
                'profile_photo_path' =>  $path,
            ]);
            // $user
            // ->addMedia($this->avatar->getRealPath())
            // ->preservingOriginal()
            // ->toMediaCollection('avatar');
        }

        session()->flash('success', 'User successfully updated.');

        return redirect()->to(route('backend.users.index'));
    }

    public function delete()
    {
        $user = User::findOrFail($this->user->id);

        if ($user->id == Auth::id()) {
            return $this->dispatchBrowserEvent('notify',[
                'type' => 'Error',
                'message' =>'You Can\'t Delete Yourself',
            ]);
        }else{

            $user->delete();

            session()->flash('success', 'User Deleted successfully.');

            return redirect()->to(route('backend.users.index'));
        }
    }
}
