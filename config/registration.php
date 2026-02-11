<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Registration secret codes
    |--------------------------------------------------------------------------
    |
    | Secret codes required to register as admin or librarian. Only users who
    | provide the correct code can register with that role. Leave empty to
    | disable registration for that role (no one can register as that role).
    |
    */

    'admin_code' => env('ADMIN_REGISTRATION_CODE', ''),

    'librarian_code' => env('LIBRARIAN_REGISTRATION_CODE', ''),

];
