<?php

namespace App\Http\Controllers;

use App\Classes\auth\Encryptor;
use App\Classes\user\UserCreatorByAdmin;
use App\Classes\user\UserCreatorWithPhone;
use App\Models\User;
use App\Models\Phone;
use JetBrains\PhpStorm\ArrayShape;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserIndexResource;
use App\Http\Resources\user\ViewUserResource;
use App\Http\Resources\user\ViewFullAttributeUserResource;
use App\Http\Resources\applicant\ViewUserApplicantResource;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends CommonController
{
    /**
     * Get all users
     */
    public function index(): AnonymousResourceCollection
    {
        return UserIndexResource::collection(User::getAll());
    }

    /**
     * Get user
     */
    public function view(): ViewFullAttributeUserResource
    {
        if (Auth::user()->isNotOwnerUser() && !Auth::user()->isAbleTo('view-user')) {
            abort(401, 'You dont have permission to do this action');
        }

        return new ViewFullAttributeUserResource(User::getUser());
    }

    /**
     * Update user
     */
    #[ArrayShape(['status' => "int", 'msg' => "string"])]
    public function update(): array
    {
        return tryCatch(
            function () {

                User::whereId(r('id'))
                    ->doUpdate()
                    ->first()
                    ->syncRole();

                Phone::updateOrCreatePhones(r('id'));

            },
            'updated',
            'error'
        );
    }

    /**
     * Get User applicants
     */
    public function getApplicants(): AnonymousResourceCollection
    {
        return ViewUserApplicantResource::collection(
            User::getApplicants()
        );
    }

    /**
     * Toggle user's activation
     */
    #[ArrayShape(['status' => "int", 'msg' => "string"])]
    public function toggleActivation(): array
    {
        $user = User::findOrFail(r('userId'));

        return tryCatch(
            fn() => $user->toggleActivation(),
            "success",
            "error"
        );
    }

    /**
     * Delete User
     */
    public function delete(): array
    {
        return Auth::id() === r('userId') ?
            jsonError(Message::LOGIN_USER_CANNOT_BE_DELETED) :
            tryCatch(
                function () {
                    $user = User::find(r('userId'));
                    $user->encryptedPassword()->delete();
                    $user->phones()->delete();
                    $user->delete();
                },
                "deleted",
                "error"
            );
    }

    /**
     * Create new user with given information
     */
    #[ArrayShape(['status' => "int", 'msg' => "string"])]
    public function create(): array
    {
        return tryCatch(
            fn() => (new UserCreatorByAdmin())->execute(),
            'created',
            'error'
        );
    }

    /**
     * Create user with mobile phone number
     */
    #[ArrayShape(['status' => "int", 'msg' => "string"])]
    public function createWithPhone()
    {
        return tryCatch(
            fn() => (new UserCreatorWithPhone())->execute(),
            'created',
            'error'
        );
    }
}
