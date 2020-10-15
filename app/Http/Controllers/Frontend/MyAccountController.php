<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AccountRegisterRequest;
use App\Http\Requests\AccountUpdateRequest;
use App\User;
use App\Role;
use App\Customer;
use Illuminate\Support\Facades\Auth;

class MyAccountController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('my-account-profile');
        }
        return view('frontend.login_register');
    }

    public function accountRegister(AccountRegisterRequest $request)
    {
        $user = User::create($request->all());
        $role = Role::firstWhere('title', 'Customer');
        $user->roles()->sync($role->id);

        $customerInputs = $request->except('password');
        $customerInputs['user_id'] = $user->id;

        $customer = Customer::create($customerInputs);

        return redirect('my-account')->with('status', 'Registration Successfully Complete! Please Sign in First');
    }

    public function profile()
    {
        if (!Auth::check())
            return redirect('my-account')->with('status', 'Please Sign in First');

        return view('frontend.profile');
    }

    public function edit_profile($id)
    {
        $user = User::find($id);
        return view('frontend.profile_edit', compact('user'));
    }

    public function update_profile(AccountUpdateRequest $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());

        if ($user->customer) {
            $user->customer->update($request->all());
        }

        return redirect()->route('my-account-profile');
    }

    public function orders()
    {
        if (!Auth::check())
            return redirect('my-account')->with('status', 'Please Sign in First');

        $user = Auth::user();

        return view('frontend.orders', compact('user'));
    }
}
