<?php

return [

    'salt' => env('UID_SALT', ''),

    'min_length' => env('UID_MIN_LENGTH', ''),

    'alphabet' => env('UID_ALPHABET', 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'),

    'column_length' => 12,

    'column_name' => 'uid',

];
