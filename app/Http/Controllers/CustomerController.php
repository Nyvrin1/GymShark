<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    // Display registration form
    public function registerForm()
    {
        return view('register');
    }

    // Handle registration form submission
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->password = Hash::make($request->password);
        $customer->isAdmin = false;
        $customer->save();
    
        Auth::login($customer); // Automatically log in the user after registration
    
        // Set a success message in the session
        return redirect()->route('home')->with('success', 'Registration completed successfully!');
    }
    

    // Display login form
    public function loginForm()
    {
        return view('login');
    }

    // Handle login form submission
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('home')->with('success', 'Logged in successfully!');
        } else {
            return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
        }
    }

    // Handle logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}
