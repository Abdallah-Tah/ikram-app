<?php

namespace App\Http\Livewire\Department;

use Livewire\Component;
use App\Models\Department;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class DepartmentResource extends Component
{
    use WithPagination;
    public $departmentId;
    public $name;
    public $search;
    public $sortBy = 'id';
    public $sortDirection = 'asc';
    public $sortAsc = true;
    public $perPage = 10;
    public $page = 1;
    protected $departments;

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
        $this->departments = Department::paginate($this->perPage, ['*'], 'page', $this->page);
    }

    public function showModal()
    {
        $this->reset();
        $this->showModal = true;
    }

    public function showDeleteModal($id)
    {
        $this->departmentId = $id;
        $this->showDeleteModal = true;
    }


    public function render()
    {
        $departments = Auth::user()->departments()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->when($this->sortBy, function ($query) {
                $query->orderBy($this->sortBy, $this->sortDirection);
            })
            ->paginate($this->perPage, ['*'], 'page', $this->page);

        return view('livewire.department.department-resource', [
            'departments' => $departments,
        ]);
    }

    public function storeDepartment()
    {
        $this->validate([
            'name' => 'required',
        ]);

        Department::create([
            'name' => $this->name,
            'user_id' => Auth::user()->id,
        ]);

        $this->reset();
        $this->showModal = false;
        $this->dispatchBrowserEvent('notify', 'Department Created Successfully!');
    }

    public function editDepartment($id)
    {
        $department = Department::find($id);
        $this->departmentId = $id;
        $this->name = $department->name;

        $this->showModal = true;
    }

    public function updateDepartment()
    {

        $this->validate([
            'name' => 'required',
        ]);

        if ($this->departmentId) {
            $department = Department::find($this->departmentId);
            $department->update([
                'name' => $this->name,
            ]);
            $this->reset();
            $this->showModal = false;
            $this->dispatchBrowserEvent('notify', 'Department Updated Successfully!');
        }
    }

    public function delete()
    {
        if ($this->departmentId) {
            $department = Department::find($this->departmentId);
            $department->delete();
            $this->showDeleteModal = false;
            $this->dispatchBrowserEvent('notify', 'Department Deleted Successfully!');
        }
    }

    public function resetInputFields()
    {
        $this->name = '';
    }
}
