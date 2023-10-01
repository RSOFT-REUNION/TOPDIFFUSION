<?php

namespace App\Http\Livewire\Pages\Back\Users;

use App\Models\CustomerGroup;
use App\Models\User;
use Livewire\Component;

class GroupeUser extends Component
{
    public $editing = false;
    public $editingFaqId = null;
    public $name = "";
    public $discount = "";

    public function startEditing($groupId)
    {
        $faq = CustomerGroup::findOrFail($groupId);
        $this->editingFaqId = $groupId;
        $this->name = $faq->name;
        $this->discount = $faq->discount_percentage;
        $this->editing = true;
    }

    public function stopEditing($groupId)
    {
        $faq = CustomerGroup::where('id', $groupId)->first();

        if ($faq) {
            $faq->name = $this->name;
            $faq->discount_percentage = $this->discount;

            $faq->update();

            $this->editing = false;
            session()->flash('success', 'La FAQ a été mise à jour avec succès');
        } else {
            session()->flash('error', 'La FAQ avec l\'ID ' . $groupId . ' n\'a pas été trouvée.');
        }

    }

    public function render()
    {
        $data = [];
        $data['usersList'] = User::where('team', '0')->get();
        $data['groupUser'] = CustomerGroup::all();
        return view('livewire.pages.back.users.group-users', $data);
    }
}
