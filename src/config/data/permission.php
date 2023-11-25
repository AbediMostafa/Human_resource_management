<?php

return [
    'applicant' => [
        'index' => 'view-applicants',
        'create' => 'create-applicant',
    ],

    'demand' => [
        'index' => 'view-demands',
        'create' => 'create-demand',
    ],

    'user' => [
        'index' => 'view-users',
        'update' => 'edit-user',
        'getRoles' => 'edit-user',
        'create' => 'create-user',
        'delete' => 'delete-user',
        'toggleActivation' => 'activate-user',
    ],

    'role' => [
        'index' => 'view-roles',
        'show' => 'view-role',
        'update' => 'edit-role',
        'create' => 'create-role',
        'delete' => 'delete-role',
    ],


];
