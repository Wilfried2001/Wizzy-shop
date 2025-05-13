<?php
// Importation des classes nécessaires
use App\Livewire\Auth\ForgotPasswordPage;
use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\Auth\ResetPasswordPage;
use App\Livewire\CancelPage;
use App\Livewire\CartPage;
use App\Livewire\CategoriesPage;
use App\Livewire\CheckoutPage;
use App\Livewire\HomePage;
use App\Livewire\MyOrderDetailPage;
use App\Livewire\MyOrdersPage;
use App\Livewire\ProductDetailPage;
use App\Livewire\ProductsPage;
use App\Livewire\SuccessPage;
use Illuminate\Support\Facades\Route;

// Commentaire Laravel sur la définition des routes web

// Route vers la page d'accueil
Route::get('/', HomePage::class);

// Route vers la page des catégories de produits
Route::get('/categories', CategoriesPage::class);

// Route vers la page listant tous les produits
Route::get('/products', ProductsPage::class);

// Route vers la page du panier
Route::get('/cart', CartPage::class);

// Route vers la page de détail d’un produit, avec paramètre {slug}
Route::get('/products/{slug}', ProductDetailPage::class);

// Routes accessibles uniquement aux utilisateurs non authentifiés
Route::middleware('guest')->group(function(){
    // Page de connexion
    Route::get('/login', LoginPage::class)->name('login');
    
    // Page d'inscription
    Route::get('/register', RegisterPage::class);
    
    // Page de demande de réinitialisation de mot de passe
    Route::get('/forgot', ForgotPasswordPage::class)->name('password.request');
    
    // Page de réinitialisation de mot de passe avec token
    Route::get('/reset/{token}', ResetPasswordPage::class)->name('password.reset');
});

// Routes accessibles uniquement aux utilisateurs authentifiés
Route::middleware('auth')->group(function(){
    // Route de déconnexion : déconnecte l'utilisateur et redirige vers l'accueil
    Route::get('/logout', function (){
        auth()->logout();
        return redirect('/');
    });

    // Page de validation de commande (checkout)
    Route::get('/checkout', CheckoutPage::class);

    // Page listant les commandes de l'utilisateur connecté
    Route::get('/my-orders', MyOrdersPage::class);

    // Page de détail d’une commande spécifique
    Route::get('/my-orders/{order_id}', MyOrderDetailPage::class)->name('my-orders.show');

    // Page de succès après paiement ou commande réussie
    Route::get('/success', SuccessPage::class)->name('success');

    // Page affichée si le paiement ou la commande a échoué
    Route::get('/cancel', CancelPage::class)->name('cancel');
});