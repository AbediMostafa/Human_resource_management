<?php

namespace App\Http\Controllers;

use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{

    protected string $validationPrefix = 'data.validation.';
    protected string $permissionPrefix = 'data.permission.';

    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $this->checkPermission();
        $this->doValidation();
        return $this->{callingMethod()}();
    }

    /**
     * Validate requests
     */
    public function doValidation()
    {
        $validationRules = config($this->validationPrefix . callingRoute() . '.' . callingMethod());
        $validationRules && r()->validate($validationRules);
    }

    /**
     * Check permissions
     */
    public function checkPermission()
    {
        $permissionRules = config($this->permissionPrefix . callingRoute() . '.' . callingMethod());

        if ($permissionRules) {
            !Auth::user()?->isAbleTo($permissionRules) &&
            abort(401, 'You dont have permission to do this action');
        }
    }
}
