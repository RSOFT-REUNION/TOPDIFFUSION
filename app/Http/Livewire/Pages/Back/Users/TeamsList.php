<?php

namespace App\Http\Livewire\Pages\Back\Users;

use App\Models\User;
use Livewire\Component;

class TeamsList extends Component
{
    public $search = '';
    public $filters_count = 0;
    public $showFilters = false;

    public $perPage = 30;

    public $clear;

    public $is_search = false;

    public $jobs = [];

    public $type;

    public $stateFiltre;

    public function filtre()
    {
        if ($this->stateFiltre === null) {
            $this->stateFiltre = 1;
        } else {
            $this->stateFiltre = null;
        }
    }

    public function updatedSearch()
    {
        $query = '%' . $this->search . '%';

        if (auth()->user()->team == 1) {
            if (strlen($this->search) > 1) {
                $this->jobs = User::where('team', 1)
                    ->where(function ($queryBuilder) use ($query) {
                        $queryBuilder->orWhere('lastname', 'like', $query)
                            ->orWhere('firstname', 'like', $query)
                            ->orWhere('customer_code', 'like', $query);
                    })
                    ->get();

                $this->is_search = true;
            } else if ($this->is_search) {
                $this->is_search = false;
                $this->jobs = [];
                User::all();
            }
        }
    }

    public function clear()
    {
        $this->search = '';
        $this->is_search = false;
        $this->jobs = [];
        $this->type = '';
    }


    public function render()
    {
        $data = [];

        if ($this->jobs) {
            $data['users'] = $this->jobs;
        } else {
            $data['users'] = User::where('team', 1)->orderBy('id', 'desc')->get();
        }

        return view('livewire.pages.back.users.teams-list', $data);
    }
}
