<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'email'                => "Le champ :attribute n'est pas une adresse email valide.",
    'same'                 => 'Les champs ":attribute" et ":other" doivent correspondrent.',
    'max'                  => [
        'string' => 'Le champ :attribute ne doit pas dépasser :max caractères.'
    ],
    'min'                  => [
        'string' => 'Le champ :attribute doit faire au minimum :min caractères.'
    ],
    'required'             => 'Le champ :attribute est obligatoire.',
    'recaptcha'            => 'Il faut cliquer sur "Je ne suis pas un robot"'

];
