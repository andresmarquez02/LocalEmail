<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginComponent extends Component
{
    public $email, $password, $log = 0;

    public function render()
    {
        return view('livewire.login-component');
    }

    public function login(){
        $this->validate([
            "email" => "required|email|max:255",
            "password" => "required|max:255",
        ]);

        if(Auth::attempt(['email' => $this->email, 'password' => $this->password])){
            $this->reset();
            $this->reg = 1;
            return redirect()->to("home");
        }
        else{
            dd("Las credenciales son incorrectas");
        }
    }
}
