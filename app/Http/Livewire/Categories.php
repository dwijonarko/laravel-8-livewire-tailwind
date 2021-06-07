<?php

namespace App\Http\Livewire;

use App\Models\Categories as ModelsCategories;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;
    public $categorie, $category_id, $name, $description;
    public $updateMode = false;
    public $showModal = false;
    public $showAlert=false;
    protected $rules = [
        'name' => 'required|min:3',
        'description' => 'required',
    ];

    public function render()
    {
        return view('livewire.categories', [
            'data' => ModelsCategories::paginate(5),
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
}
