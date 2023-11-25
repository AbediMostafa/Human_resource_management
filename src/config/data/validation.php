<?php

use Illuminate\Validation\Rule;

return [
    'applicant' => [
        'create' => [
            'first_name' => 'required',
            'last_name' => 'required',
            'age' => 'bail|required|numeric|between:10,80',
            'international_code' => ['unique:applicants,international_code', 'required', new \App\Rules\NationalCode()],
            'height' => 'bail|required|numeric|between:50,250',
            'gender' => ['required', Rule::in(['male', 'female'])],
            'presenter_id' => 'required|exists:users,id',
            'degree_id' => 'required|exists:degrees,id',
            'originality_id' => 'required|exists:originalities,id'
        ],
        'update' => [
            'first_name' => 'required',
            'last_name' => 'required',
            'age' => 'bail|required|numeric|between:10,80',
            'international_code' => ['unique:applicants,international_code', 'required', new \App\Rules\NationalCode()],
            'height' => 'bail|required|numeric|between:50,250',
            'gender' => ['required', Rule::in(['male', 'female'])],
            'presenter_id' => 'required|exists:users,id',
            'degree_id' => 'required|exists:degrees,id',
            'originality_id' => 'required|exists:originalities,id'
        ],
        'delete' => [
            'appId' => 'required|exists:applicants,id'
        ]
    ],
    'country' => [
        'create' => [
            'title' => 'unique:countries,title',
        ],
        'update' => [
            'title' => 'unique:countries,title,' . request('countryId'),
        ],
    ],
    'state' => [
        'create' => [
            'title' => 'unique:states,title',
            'country_id' => 'required'
        ],
        'update' => [
            'title' => 'unique:states,title,' . request('id'),
            'country_id' => 'required'
        ]
    ],
    'color' => [
        'create' => [
            'title' => 'unique:colors,title',
        ],
        'update' => [
            'title' => 'unique:colors,title,' . request('id'),
        ],
    ],
    'tag' => [
        'create' => [
            'title' => 'unique:tags,title',
        ],
        'update' => [
            'title' => 'unique:tags,title,' . request('id'),
        ],
    ],

    'university' => [
        'create' => [
            'title' => 'unique:universities,title',
        ],
        'update' => [
            'title' => 'unique:universities,title,' . request('id'),
        ],
    ],
    'originality' => [
        'create' => [
            'title' => 'unique:originalities,title',
        ],
        'update' => [
            'title' => 'unique:originalities,title,' . request('id'),
        ],
    ],

    'user' => [
        'update' => [

            'first_name' => 'required',
            'last_name' => 'required',
            'international_code' => 'required|unique:users,international_code,' . request('id'),
            'roleIds' => 'array|required',
            'roleIds.*' => 'exists:roles,id',
        ],
        'create' => [
            'first_name' => 'required',
            'last_name' => 'required',
            'international_code' => 'required|unique:users,international_code',
            'roleIds' => 'array|required',
            'roleIds.*' => 'exists:roles,id',
            'mobilePhone' => 'unique:phones,number',
        ]
    ],

    'role' => [
        'update' => [
            'role.name' => 'required|unique:roles,name,' . request('role.id'),
            'role.displayName' => 'required|unique:roles,display_name,' . request('role.id'),
            'role.permissionIds' => 'array|required',
            'role.permissionIds.*' => 'exists:permissions,id',
        ],
        'create' => [
            'role.name' => 'required|unique:roles,name',
            'role.displayName' => 'required|unique:roles,display_name',
            'role.permissionIds' => 'array|required',
            'role.permissionIds.*' => 'exists:permissions,id',
        ]
    ],

    'permission' => [
        'create' => [
            'permission.name' => 'required|unique:permissions,name',
            'permission.display_name' => 'required|unique:permissions,display_name',
        ]
    ]
];
