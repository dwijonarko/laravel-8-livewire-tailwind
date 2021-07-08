<?php

namespace App\Http\Livewire;

use App\Models\Categories as ModelsCategories;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;
    public $categories, $category_id, $name, $description,$searchParam;
    public $updateMode = false;
    public $showModal = false;
    public $showAlert=false;
    public $columnOrder = 'id';
    public $order = 'ASC';
    protected $rules = [
        'name' => 'required|min:3',
        'description' => 'required',
    ];

    public function render()
    {
        $searchParam = '%'.$this->searchParam.'%';
        $order = $this->order;
        $columnOrder = $this->columnOrder;
        return view('livewire.categories', [
            'data' => ModelsCategories::orderBy($columnOrder,$order)->where('name','like',$searchParam)->paginate(5),
        ]);
    }

    public function store()
    {
        $this->validate();
        ModelsCategories::create(['name' => $this->name,'description'=>$this->description]);
        session()->flash('message', 'Category Created Successfully.');
        $this->resetInputFields();
        $this->showModal = false;
    }

    public function edit($id){
        $category = ModelsCategories::find($id);
        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->description = $category->description;
        $this->showModal = true ;
    }

    public function update($id){
        $this->validate();
        ModelsCategories::find($id)->update(['name' => $this->name,'description'=>$this->description]);
        session()->flash('message', 'Category Updated Successfully.');
        $this->resetInputFields();
        $this->showModal = false;
        
    }

    public function openModal($arg){
        $this->showModal = $arg ;
        
    }

    public function cancel()
    {
        $this->showModal = false; 
        $this->showAlert = false;
        $this->resetInputFields();
        
    }

    public function delete($id){
        $this->showAlert = true;
        $this->category_id = $id;
    }

    public function performDelete(){
        ModelsCategories::find($this->category_id)->delete();
        session()->flash('message', 'Category Deleted Successfully.');
        $this->showAlert = false;
        $this->resetInputFields();
    }

    public function resetInputFields()
    {
        $this->category_id='';
        $this->name = '';
        $this->description = '';
    }

    public function sort($column){
        $this->order = $this->order == 'ASC' ? 'DESC' : 'ASC';
        $this->columnOrder = $column;
    }
}
