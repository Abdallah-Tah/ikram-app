<?php

namespace App\Http\Livewire\Plan;

use App\Models\Plan;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class PlanResource extends Component
{
    use WithPagination;
    public $planId;
    public $name;
    public $search;
    public $sortBy = 'id';
    public $sortDirection = 'asc';
    public $sortAsc = true;
    public $perPage = 10;
    public $page = 1;
    protected $plans;

    public $showModal = false;
    public $showDeleteModal = false;


    public function sortBy($field)
    {
        if ($this->sortDirection == 'asc') {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }

        return $this->sortBy = $field;
    }

    public function mount()
    {
        $plans = Plan::paginate($this->perPage, ['*'], 'page', $this->page);
    }

    public function showModal()
    {
        $this->reset();
        $this->showModal = true;
    }

    public function showDeleteModal($id)
    {
        $this->planId = $id;
        $this->showDeleteModal = true;
    }


    public function render()
    {
        $plans = Auth::user()->plans()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->when($this->sortBy, function ($query) {
                $query->orderBy($this->sortBy, $this->sortDirection);
            })
            ->paginate($this->perPage, ['*'], 'page', $this->page);

        return view('livewire.plan.plan-resource', [
            'plans' => $plans,
        ]);
    }

    public function storePlan()
    {
        $this->validate([
            'name' => 'required',
        ]);

        Plan::create([
            'name' => $this->name,
            'user_id' => Auth::user()->id,
        ]);

        $this->reset();
        $this->showModal = false;
        $this->dispatchBrowserEvent('notify', 'Plan Created Successfully!');
    }

    public function editPlan($id)
    {
        $plan = Plan::find($id);
        $this->planId = $id;
        $this->name = $plan->name;

        $this->showModal = true;
    }

    public function updatePlan()
    {

        $this->validate([
            'name' => 'required',
        ]);

        if ($this->planId) {
            $plan = Plan::find($this->planId);
            $plan->update([
                'name' => $this->name,
            ]);
            $this->reset();
            $this->showModal = false;
            $this->dispatchBrowserEvent('notify', 'Plan Updated Successfully!');
        }
    }

    public function delete()
    {
        if ($this->planId) {
            $plan = Plan::find($this->planId);
            $plan->delete();
            $this->showDeleteModal = false;
            $this->dispatchBrowserEvent('notify', 'Plan Deleted Successfully!');
        }
    }

    public function resetInputFields()
    {
        $this->name = '';
    }
}
