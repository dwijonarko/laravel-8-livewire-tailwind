<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\UserLevel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class Users extends Component
{
    use WithPagination;
    public $users, $user_id, $username, $name, $email, $password, $level_id, $levels, $searchParam;
    public $updateMode = false;
    public $showModal = false;
    public $showAlert = false;
    public $columnOrder = 'id';
    public $order = 'ASC';
    protected $rules = [];

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'username' => 'required|string|min:3|max:32|unique:users,id,' . $this->user_id,
            'email' => 'required|string|email|max:255|unique:users,id,' . $this->user_id,
            'level_id' => 'required',
        ];
    }

    public function mount()
    {
        $this->levels = UserLevel::pluck('name', 'id');
        $this->rules = $this->rules();
    }

    public function render()
    {

        $searchParam = '%' . $this->searchParam . '%';
        $order = $this->order;
        $columnOrder = $this->columnOrder;
        return view('livewire.users', [
            'data' => User::orderBy($columnOrder, $order)->where('name', 'like', $searchParam)->paginate(5),
        ]);
    }

    public function store()
    {
        $this->validate();
        User::create([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'level_id' => $this->level_id,
            'password' => Hash::make($this->username)
        ]);
        session()->flash('message', 'user Created Successfully.');
        $this->resetInputFields();
        $this->showModal = false;
    }

    public function edit($id)
    {
        $user = User::find($id);

        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->level_id = $user->level_id;
        $this->showModal = true;
    }

    public function update($id)
    {
        $this->validate();
        User::find($id)->update([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'level_id' => $this->level_id
        ]);
        session()->flash('message', 'user Updated Successfully.');
        $this->resetInputFields();
        $this->showModal = false;
    }

    public function openModal($arg)
    {
        $this->showModal = $arg;
    }

    public function cancel()
    {
        $this->showModal = false;
        $this->showAlert = false;
        $this->resetInputFields();
    }

    public function delete($id)
    {
        $this->showAlert = true;
        $this->user_id = $id;
    }

    public function performDelete()
    {
        User::find($this->user_id)->delete();
        session()->flash('message', 'user Deleted Successfully.');
        $this->showAlert = false;
        $this->resetInputFields();
    }

    public function resetInputFields()
    {
        $this->user_id = '';
        $this->name = '';
        $this->username = '';
        $this->email = '';
        $this->level_id = '';
    }

    public function sort($column)
    {
        $this->order = $this->order == 'ASC' ? 'DESC' : 'ASC';
        $this->columnOrder = $column;
    }
}
