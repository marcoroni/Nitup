<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function indexHome() {
        if(\Auth::check()) {
            return view('master', ['section' => 'home', 'user' => Auth::user()]);
        }
        else {
            return view('master', ['section' => 'home']);
        }
    }

    public function indexLogin() {
        if(!\Auth::check()) {
            return view('master', ['section' => 'login']);
        }
        else {
            return redirect('/')->withErrors('U bent al ingelogd');
        }
    }

    public function indexRegister() {
        return view('master', ['section' => 'register']);
    }

    public function indexGames() {
        if(isset($_GET['search'])) {
            $products = Product::where('name', 'like', '%' . $_GET['search'] . '%')->get();
        } else{
            $products = Product::get();
        }

        $categories = Product::groupBy('category')->get(['category']);

        if(\Auth::check()) {
            return view('master', ['section' => 'games', 'user' => Auth::user(),'products' => $products, 'categories' => $categories]);
        }
        else {
            return view('master', ['section' => 'games','products' => $products, 'categories' => $categories]);
        }
    }

    public function indexCategory($category) {
        $products = Product::where('category', $category)->get();
        $categories = Product::groupBy('category')->get(['category']);
        if(\Auth::check()) {
            if(empty($products)) return view('master', ['section' => 'games', 'user' => Auth::user(), 'categories' => $categories])->withErrors("de gekozen categorie bestaat momenteel niet.");

            return view('master', ['section' => 'games', 'user' => Auth::user(),'products' => $products, 'categories' => $categories]);
        }
        else {
            if(empty($products)) return view('master', ['section' => 'games', 'categories' => $categories])->withErrors("de gekozen categorie bestaat momenteel niet.");

            return view('master', ['section' => 'games', 'products' => $products, 'categories' => $categories]);
        }
    }

    public function productNew() {
        if(\Auth::user()['rank'] == 'admin') {
            return view('master', ['section' => 'newProduct', 'user' => Auth::user()]);
        } else {
            return redirect('/')->withErrors('U hebt geen toegang tot deze link');
        }
    }

    public function indexContact() {
        if(\Auth::check()) {
            return view('master', ['section' => 'contact', 'user' => Auth::user()]);
        }
        else {
            return view('master', ['section' => 'contact']);
        }
    }

    public function indexTetris() {
        if(\Auth::check()) {
            return view('master', ['section' => 'tetris', 'user' => Auth::user()]);
        }
        else {
            return view('master', ['section' => 'tetris']);
        }
    }
    public function indexMario() {
        if(\Auth::check()) {
            return view('master', ['section' => 'mario', 'user' => Auth::user()]);
        }
        else {
            return view('master', ['section' => 'mario']);
        }
    }

    public function indexPacman() {
        if(\Auth::check()) {
            return view('master', ['section' => 'pacman', 'user' => Auth::user()]);
        }
        else {
            return view('master', ['section' => 'pacman']);
        }
    }
}
