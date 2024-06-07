<?php

return [
    'accepted'             => 'Pole :attribute musi zostać zaakceptowane.',
    'active_url'           => 'Pole :attribute jest nieprawidłowym adresem URL.',
    'after'                => 'Pole :attribute musi być datą późniejszą od :date.',
    'after_or_equal'       => 'Pole :attribute musi być datą nie wcześniejszą niż :date.',
    'alpha'                => 'Pole :attribute może zawierać jedynie litery.',
    'alpha_dash'           => 'Pole :attribute może zawierać jedynie litery, cyfry i myślniki.',
    'alpha_num'            => 'Pole :attribute może zawierać jedynie litery i cyfry.',
    'array'                => 'Pole :attribute musi być tablicą.',
    'before'               => 'Pole :attribute musi być datą wcześniejszą od :date.',
    'before_or_equal'      => 'Pole :attribute musi być datą nie późniejszą niż :date.',
    'between'              => [
        'numeric' => 'Pole :attribute musi zawierać się w przedziale :min - :max.',
        'file'    => 'Pole :attribute musi zawierać się w przedziale :min - :max kilobajtów.',
        'string'  => 'Pole :attribute musi zawierać się w przedziale :min - :max znaków.',
        'array'   => 'Pole :attribute musi składać się z :min - :max elementów.',
    ],
    'boolean'              => 'Pole :attribute musi mieć wartość prawda lub fałsz.',
    'confirmed'            => 'Potwierdzenie pola :attribute nie zgadza się.',
    'date'                 => 'Pole :attribute nie jest prawidłową datą.',
    'date_equals'          => 'Pole :attribute musi być datą równą :date.',
    'date_format'          => 'Pole :attribute nie zgadza się z formatem :format.',
    'different'            => 'Pole :attribute oraz :other muszą się różnić.',
    'digits'               => 'Pole :attribute musi składać się z :digits cyfr.',
    'digits_between'       => 'Pole :attribute musi mieć od :min do :max cyfr.',
    'dimensions'           => 'Pole :attribute ma nieprawidłowe wymiary.',
    'distinct'             => 'Pole :attribute ma zduplikowane wartości.',
    'email'                => 'Pole :attribute musi być prawidłowym adresem email.',
    'ends_with'            => 'Pole :attribute musi kończyć się jedną z następujących wartości: :values.',
    'exists'               => 'Zaznaczone pole :attribute jest nieprawidłowe.',
    'file'                 => 'Pole :attribute musi być plikiem.',
    'filled'               => 'Pole :attribute jest wymagane.',
    'gt'                   => [
        'numeric' => 'Pole :attribute musi być większe niż :value.',
        'file'    => 'Pole :attribute musi być większe niż :value kilobajtów.',
        'string'  => 'Pole :attribute musi być dłuższe niż :value znaków.',
        'array'   => 'Pole :attribute musi mieć więcej niż :value elementów.',
    ],
    'gte'                  => [
        'numeric' => 'Pole :attribute musi być większe lub równe :value.',
        'file'    => 'Pole :attribute musi być większe lub równe :value kilobajtów.',
        'string'  => 'Pole :attribute musi być dłuższe lub równe :value znaków.',
        'array'   => 'Pole :attribute musi mieć :value elementów lub więcej.',
    ],
    'image'                => 'Pole :attribute musi być obrazkiem.',
    'in'                   => 'Pole :attribute jest nieprawidłowe.',
    'in_array'             => 'Pole :attribute nie istnieje w :other.',
    'integer'              => 'Pole :attribute musi być liczbą całkowitą.',
    'ip'                   => 'Pole :attribute musi być prawidłowym adresem IP.',
    'ipv4'                 => 'Pole :attribute musi być prawidłowym adresem IPv4.',
    'ipv6'                 => 'Pole :attribute musi być prawidłowym adresem IPv6.',
    'json'                 => 'Pole :attribute musi być poprawnym łańcuchem znaków JSON.',
    'lt'                   => [
        'numeric' => 'Pole :attribute musi być mniejsze niż :value.',
        'file'    => 'Pole :attribute musi być mniejsze niż :value kilobajtów.',
        'string'  => 'Pole :attribute musi być krótsze niż :value znaków.',
        'array'   => 'Pole :attribute musi mieć mniej niż :value elementów.',
    ],
    'lte'                  => [
        'numeric' => 'Pole :attribute musi być mniejsze lub równe :value.',
        'file'    => 'Pole :attribute musi być mniejsze lub równe :value kilobajtów.',
        'string'  => 'Pole :attribute musi być krótsze lub równe :value znaków.',
        'array'   => 'Pole :attribute nie może mieć więcej niż :value elementów.',
    ],
    'max'                  => [
        'numeric' => 'Pole :attribute nie może być większe niż :max.',
        'file'    => 'Pole :attribute nie może być większe niż :max kilobajtów.',
        'string'  => 'Pole :attribute nie może być dłuższe niż :max znaków.',
        'array'   => 'Pole :attribute nie może mieć więcej niż :max elementów.',
    ],
    'mimes'                => 'Pole :attribute musi być plikiem typu: :values.',
    'mimetypes'            => 'Pole :attribute musi być plikiem typu: :values.',
    'min'                  => [
        'numeric' => 'Pole :attribute musi być większe lub równe :min.',
        'file'    => 'Pole :attribute musi mieć przynajmniej :min kilobajtów.',
        'string'  => 'Pole :attribute musi mieć przynajmniej :min znaków.',
        'array'   => 'Pole :attribute musi mieć przynajmniej :min elementów.',
    ],
    'multiple_of'          => 'Pole :attribute musi być wielokrotnością :value',
    'not_in'               => 'Pole :attribute jest nieprawidłowe.',
    'not_regex'            => 'Format pola :attribute jest nieprawidłowy.',
    'numeric'              => 'Pole :attribute musi być liczbą.',
    'password'             => 'Hasło jest nieprawidłowe.',
    'present'              => 'Pole :attribute musi być obecne.',
    'regex'                => 'Format pola :attribute jest nieprawidłowy.',
    'required'             => 'Pole :attribute jest wymagane.',
    'required_if'          => 'Pole :attribute jest wymagane, gdy :other jest :value.',
    'required_unless'      => 'Pole :attribute jest wymagane, chyba że :other jest w :values.',
    'required_with'        => 'Pole :attribute jest wymagane, gdy :values jest obecne.',
    'required_with_all'    => 'Pole :attribute jest wymagane, gdy :values jest obecne.',
    'required_without'     => 'Pole :attribute jest wymagane, gdy :values nie jest obecne.',
    'required_without_all' => 'Pole :attribute jest wymagane, gdy żadne z :values nie jest obecne.',
    'same'                 => 'Pole :attribute i :other muszą być zgodne.',
    'size'                 => [
        'numeric' => 'Pole :attribute musi mieć :size.',
        'file'    => 'Pole :attribute musi mieć :size kilobajtów.',
        'string'  => 'Pole :attribute musi mieć :size znaków.',
        'array'   => 'Pole :attribute musi zawierać :size elementów.',
    ],
    'starts_with'          => 'Pole :attribute musi zaczynać się od jednej z następujących wartości: :values',
    'string'               => 'Pole :attribute musi być ciągiem znaków.',
    'timezone'             => 'Pole :attribute musi być prawidłową strefą czasową.',
    'unique'               => 'Pole :attribute jest już zajęte.',
    'uploaded'             => 'Nie udało się załadować pliku :attribute.',
    'url'                  => 'Format pola :attribute jest nieprawidłowy.',
    'uuid'                 => 'Pole :attribute musi być poprawnym identyfikatorem UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'amount' => [
            'min' => 'Kwota musi być co najmniej :min.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'name' => 'nazwa',
        'email' => 'adres email',
        'password' => 'hasło',
        'amount' => 'kwota',
        'date' => 'data',
        'description' => 'opis',
    ],

];
