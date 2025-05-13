<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Component;
#[Title('Register')]

class RegisterPage extends Component
{
    public $name;
    public $email;
    public $password;

     // Méthode appelée à la soumission du formulaire pour enregistrer l'utilisateur
    // register user
    public function save(){
        // Valide les données saisies selon les règles définies
        $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6|max:255',
        ]);

         // Crée un nouvel utilisateur dans la base de données avec les données validées
        // save to database
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        // Connecte automatiquement l'utilisateur nouvellement enregistré
        // login user
        auth()->login($user);
        
        // Redirige vers la page prévue après connexion (par défaut la page d'accueil)
        // redirect to home page
        return redirect()->intended();
    }
    public function render()
    {
        return view('livewire.auth.register-page');
    }
}