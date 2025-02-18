<?php

return [
    'Users.SimpleRbac.permissions' => [
        // admin role allowed to all the things
        [
            'role' => 'admin',
            'prefix' => '*',
            'extension' => '*',
            'plugin' => '*',
            'controller' => '*',
            'action' => '*',
        ],
        // specific actions allowed for the all roles in Users plugin
        [
            'role' => '*',
            'plugin' => 'CakeDC/Users',
            'controller' => 'Users',
            'action' => ['logout'],
        ],
        // this is just an example
        [
            'role' => '*',
            'plugin' => 'CakeDC/Users',
            'controller' => 'Users',
            'action' => 'resetGoogleAuthenticator',
            'allowed' => function (array $user, $role, \Cake\Http\ServerRequest $request) {
                $userId = \Cake\Utility\Hash::get($request->getAttribute('params'), 'pass.0');
                if (!empty($userId) && !empty($user)) {
                    return $userId === $user['id'];
                }

                return false;
            }
        ],
        // authenticated user is allowed to access ReAuthenticate Controller
        [
            'role' => '*',
            'plugin' => false,
            'prefix' => false,
            'controller' => 'ReAuthenticate',
            'action' => '*',
            'allowed' => true,
        ],
        // authenticated user is allowed to access his/her own profile
        [
            'role' => '*',
            'plugin' => false,
            'prefix' => 'Me',
            'controller' => '*',
            'action' => '*',
            'allowed' => true,
        ],
        // authenticated user is allowed to access api
        [
            'role' => '*',
            'plugin' => false,
            'prefix' => 'api/v1',
            'controller' => '*',
            'action' => '*',
            'allowed' => true,
        ],
    ]
];