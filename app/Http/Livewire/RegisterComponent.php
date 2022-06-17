<?php

namespace App\Http\Livewire;

use App\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RegisterComponent extends Component
{
    public $fullname, $email, $password, $reg = 0;

    public function render()
    {
        return view('livewire.register-component');
    }

    public function register(){
        $this->validate([
            "fullname" => "required|max:255",
            "email" => "required|email|max:255|unique:users,email",
            "password" => "required|max:255",
        ]);
        User::create([
            "name" => $this->fullname,
            "email" => $this->email,
            "password" => bcrypt($this->password)
        ]);
        $this->reset();
        $this->reg = 1;
        return redirect()->to("login");
    }
}
