<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\user\UpdateProfileUserRequest;
use App\Repositories\User\UserRepository;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function edit($id)
    {
        $user = $this->userRepository->getById($id);
        return view('admin.pages.profile.edit', compact('user'));
    }

    public function update(UpdateProfileUserRequest $request, $id): RedirectResponse
    {
        try{
            $this->userRepository->updateProfile($request->all(), $id);
            return redirect()->route('home.index');
        }catch (\Exception $e){
            abort(500);
        }
    }
}
