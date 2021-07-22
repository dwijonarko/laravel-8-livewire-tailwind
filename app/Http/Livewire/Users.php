<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Validation\Rules;
class Users extends Component
{ 
    use WithPagination;
    public $users,$user_id, $username, $name, $email, $password, $level_id,$searchParam;
    public $updateMode = false;
    public $showModal = false;
    public $showAlert=false;
    public $columnOrder = 'id';
    public $order = 'ASC';

    protected $rules = [
        'name' => 'required|string|max:255',
        'username' => 'required|string|min:3|max:32|unique:users',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|confirmed',
        'level_id' => 'required'
    ];

    public function render()
    {
        $searchParam = '%'.$this->searchParam.'%';
        $order = $this->order;
        $columnOrder = $this->columnOrder;
        return view('livewire.users', [
            'data' => User::orderBy($columnOrder,$order)->where('name','like',$searchParam)->paginate(5),
        ]);
    }

    public function store()
    {
        $this->validate();
        User::create(['name' => $this->name,'description'=>$this->description]);
        session()->flash('message', 'user Created Successfully.');
        $this->resetInputFields();
        $this->showModal = false;
    }

    public function edit($id){
        $user = User::find($id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->description = $user->description;
        $this->showModal = true ;
    }

    public function update($id){
        $this->validate();
        User::find($id)->update(['name' => $this->name,'description'=>$this->description]);
        session()->flash('message', 'user Updated Successfully.');
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
        $this->user_id = $id;
    }

    public function performDelete(){
        User::find($this->user_id)->delete();
        session()->flash('message', 'user Deleted Successfully.');
        $this->showAlert = false;
        $this->resetInputFields();
    }

    public function resetInputFields()
    {
        $this->user_id='';
        $this->name = '';
        $this->description = '';
    }

    public function sort($column){
        $this->order = $this->order == 'ASC' ? 'DESC' : 'ASC';
        $this->columnOrder = $column;
    }
    
}
