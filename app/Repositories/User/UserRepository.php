<?php

namespace App\Repositories\User;

use App\Traits\HandleImage;
use App\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;

/**
 *
 */
class UserRepository extends BaseRepository
{
    use HandleImage;

    public $path = "admin-assets/uploads/user/";

    public function model(): string
    {
        return User::class;

    }

    public function getUserByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function getWithPaginate($quantity = 5)
    {
        return $this->model->latest()->paginate($quantity);
    }

    public function getById($id, $columns = ['*'])
    {
        return $this->model->find($id);
    }

    public function create($request): bool
    {
        $user =  $this->model->create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if($user){
            return true;
        }
        return false;
    }

    public function checkLogin($request)
    {
        $user = $this->getUserByEmail($request->email);
        if (!empty($user)) {
            if (Hash::check($request->password, $user->password)) {
                session()->put('user_id', $user->id);
                session()->put('user_email', $user->email);
                return true;
            }
        }
        return false;
    }

    public function update($request, $id): bool
    {
        $user = $this->getById($id);
        if ($user) {
            $imageName = $user->avatar;
            $avatar = $this->updateImage($request->file('avatar'), $imageName, $this->path);
            $user->update([
                'name' => $request->name,
                'avatar' => $avatar,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
            $user->roles()->detach();
            $user->roles()->attach($request->roles);
            return true;
        }
        return false;
    }

    public function updateProfile($attribute, $id)
    {
        $user = $this->getById($id);
        if(array_key_exists('avatar', $attribute)){
            if($user->avatar){
                deleteImage($user->avatar);
            }
            $data['avatar'] = saveImage($attribute['avatar']);
        }

        $data['name'] = $attribute['name'];
        $data['email'] = $attribute['email'];
        $data['phone'] = $attribute['phone'];
        return $user->update($data);
    }

    public function delete($id): bool
    {
        $user = $this->model->find($id);
        if ($user) {
            $user->destroy($id);
            //delete role of user
            $this->deleteImage($user->avatar, $this->path);
            $user->roles()->detach();
            return true;
        }
        return false;
    }

    public function search($request)
    {
        return $this->getWithPaginate(2);
    }
}
