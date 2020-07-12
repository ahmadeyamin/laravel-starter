<?php

namespace App\Http\Livewire\Bankend\Menu;

use Livewire\Component;
use App\Models\Backend\Menu;

class Edit extends Component
{

    public $name,$description,$selectedmenu;

    protected $listeners = ['editMenu'];


    public function editMenu($id)
    {
        $menu = Menu::findOrFail($id);
        $this->selectedmenu = $menu->id;
        $this->name = $menu->name;
        $this->description = $menu->description;
    }

    public function render()
    {
        return view('livewire.bankend.menu.edit');
    }



    public function delete()
    {
        $menu = Menu::findOrFail($this->selectedmenu);


        $menu->delete();




        session()->flash('success', 'Menu Deleted successfully.');

        return redirect()->to(route('backend.menus.index'));
    }

}
