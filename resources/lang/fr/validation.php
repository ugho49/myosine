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
    'different'            => 'Les champs :attribute et :other doivent être différents.',
    'date'                 => "Le champ :attribute n'est pas une date valide.",
    'date_format'          => "Le champ :attribute n'est pas au bon format.",
    'max'                  => [
        'string' => 'Le champ :attribute ne doit pas dépasser :max caractères.'
    ],
    'min'                  => [
        'string' => 'Le champ :attribute doit faire au minimum :min caractères.',
        'numeric' => 'Le champ :attribute doit faire au minimum :min.',
    ],
    'numeric'              => 'Le champ :attribute doit être un nombre.',
    'unique'               => 'Le champ :attribute est déjà utilisé en base.',
    'required'             => 'Le champ :attribute est obligatoire.',
    'required_with'        => 'Le champ :attribute est requis quand le champ :values est renseigné.',
    'recaptcha'            => 'Il faut cliquer sur "Je ne suis pas un robot"'

];
