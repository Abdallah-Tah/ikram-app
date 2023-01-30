<?php

namespace App\Http\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class CategoryResource extends Component
{
    use WithPagination;
    public $categoryId;
    public $name;
    public $search;
    public $sortBy = 'id';
    public $sortDirection = 'asc';
    public $sortAsc = true;
    public $perPage = 10;
    public $page = 1;
    protected $categories;

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
        $this->categories = Category::paginate($this->perPage, ['*'], 'page', $this->page);
    }

    public function showModal()
    {
        $this->reset();
        $this->showModal = true;
    }

    public function showDeleteModal($id)
    {
        $this->categoryId = $id;
        $this->showDeleteModal = true;
    }


    public function render()
    {
        $categories = Auth::user()->categories()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->when($this->sortBy, function ($query) {
                $query->orderBy($this->sortBy, $this->sortDirection);
            })
            ->paginate($this->perPage, ['*'], 'page', $this->page);

        return view('livewire.category.category-resource', [
            'categories' => $categories,
        ]);
    }

    public function storeCategory()
    {
        $this->validate([
            'name' => 'required',
        ]);

      $category = Category::create([
            'name' => $this->name,
            'user_id' => Auth::user()->id,
        ]);

        $this->reset();
        $this->showModal = false;
        $this->dispatchBrowserEvent('notify', 'Category Created Successfully!');
    }

    public function editCategory($id)
    {
        $category = Category::find($id);
        $this->categoryId = $id;
        $this->name = $category->name;

        $this->showModal = true;
    }

    public function updateCategory()
    {

        $this->validate([
            'name' => 'required',
        ]);

        if ($this->categoryId) {
           $category = Category::find($this->categoryId);
            $category->update([
                'name' => $this->name,
            ]);
            $this->reset();
            $this->showModal = false;
            $this->dispatchBrowserEvent('notify', 'Category Updated Successfully!');
        }
    }

    public function delete($id)
    {
        if ($this->categoryId) {
            $category = Category::find($this->categoryId);
            $category->delete();
            $this->showDeleteModal = false;
            $this->dispatchBrowserEvent('notify', 'Category Deleted Successfully!');
        }
    }

    public function resetInputFields()
    {
        $this->name = '';
    }
}
