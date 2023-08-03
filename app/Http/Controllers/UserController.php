<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Libs\ConfigUtil;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    /**
     * Render screen Login
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function login() {
        
        $pageTitle = 'Login';

        return view('partials.form.login', compact('pageTitle'));
    }

    /**
     * Handle check account exists or not
     * 
     * @param App\Http\Requests\UserRequest $request
     * @return mixed redirect dashboard | back
     */
    public function checkLogin(UserRequest $request) {
        $userDupplicateEmail = $this->userRepository->dupllicateEmail($request->email);
        
        if($userDupplicateEmail->count() > 1) {
            return back()
                ->with('success', false)
                ->with('message', ConfigUtil::getMessage('EBT016'));
            
        }
        if(Auth::attempt(array_merge($request->only(['email', 'password']), ['deleted_date' => null]))) {
            $ridirecTo = 'admin/dashboard';
       
            if($request->session()->get('previous_url')) {
                $ridirecTo = $request->session()->get('previous_url');
                $request->session()->forget('previous_url');
            }

            return redirect()->intended($ridirecTo);
        }
        
        return back()
            ->with('success', false)
            ->with('message', ConfigUtil::getMessage('EBT016'));
    }

    /**
     * Remove the authentication information from the user's session
     * 
     * @param App\Http\Requests\UserRequest $request
     * @return redirect login
     */
    public function logout(Request $request) {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }

     /** 
     * Check exists email in database <> user login 
     * 
     * @param App\Http\Requests\Request $request
     * @return boolean true|false
     */
    public function checkExistsEmail(Request $request) {
        if(isset($request->id)) {
            $user = $this->userRepository->getByEmail($request->email, $request->id);
        } else {
            $user = $this->userRepository->getByEmail($request->email);
        }

        if ($user->count()) {
            return Response::json(true);
        }
        
        return Response::json(false);
    }

    /** 
     * Check duplicate email in database 
     * 
     * @param App\Http\Requests\Request $request
     * @return boolean true|false
     */
    public function checkDuplicateEmail(Request $request) {
        $users = $this->userRepository->getByEmail($request->email);

        if ($users->count() >= 2) {
            return Response::json(true);
        }
        
        return Response::json(false);
    }
}
