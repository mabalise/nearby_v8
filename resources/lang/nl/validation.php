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

    'accepted'             => 'Het :attribute moet worden geaccepteerd.',
    'active_url'           => 'Het :attribute is geen geldige URL.',
    'after'                => 'Het :attribute moet een datum erna zijn :date.',
    'after_or_equal'       => 'Het :attribute moet een datum na of gelijk aan zijn :date.',
    'alpha'                => 'Het :attribute mag alleen letters bevatten.',
    'alpha_dash'           => 'Het :attribute mag alleen letters, cijfers, streepjes en onderstrepingstekens bevatten.',
    'alpha_num'            => 'Het :attribute mag alleen letters en cijfers bevatten.',
    'array'                => 'Het :attribute moet een array zijn.',
    'before'               => 'Het :attribute moet een datum ervoor zijn :date.',
    'before_or_equal'      => 'Het :attribute moet een datum vóór of gelijk aan zijn :date.',
    'between'              => [
        'numeric' => 'Het :attribute moet tussen :min en :max.',
        'file'    => 'Het :attribute moet tussen :min en :max kilobytes.',
        'string'  => 'Het :attribute moet tussen :min and :max characters.',
        'array'   => 'Het :attribute moet hebben tussen :min en :max items.',
    ],
    'boolean'              => 'Het :attribute veld moet waar of onwaar zijn.',
    'confirmed'            => 'Het :attribute bevestiging komt niet overeen.',
    'date'                 => 'Het :attribute is geen geldige datum.',
    'date_format'          => 'Het :attribute komt niet overeen met het formaat :format.',
    'different'            => 'Het :attribute en :other moet anders zijn.',
    'digits'               => 'Het :attribute moet :digits digits.',
    'digits_between'       => 'Het :attribute moet tussen :min en :max digits.',
    'dimensions'           => 'Het :attribute heeft ongeldige afbeeldingsafmetingen.',
    'distinct'             => 'Het :attribute veld heeft een dubbele waarde.',
    'email'                => 'Het :attribute Moet een geldig e-mail adres zijn.',
    'exists'               => 'De geselecteerde :attribute is ongeldig.',
    'file'                 => 'Het :attribute moet een bestand zijn.',
    'filled'               => 'Het :attribute veld moet een waarde hebben.',
    'gt'                   => [
        'numeric' => 'Het :attribute moet groter zijn dan :value.',
        'file'    => 'Het :attribute moet groter zijn dan :value kilobytes.',
        'string'  => 'Het :attribute moet groter zijn dan :value characters.',
        'array'   => 'Het :attribute moet groter zijn dan :value items.',
    ],
    'gte'                  => [
        'numeric' => 'Het :attribute moet groter zijn dan of gelijk zijn :value.',
        'file'    => 'Het :attribute moet groter zijn dan of gelijk zijn :value kilobytes.',
        'string'  => 'Het :attribute moet groter zijn dan of gelijk zijn :value characters.',
        'array'   => 'Het :attribute moet hebben :value items or more.',
    ],
    'image'                => 'Het :attribute moet een afbeelding zijn.',
    'in'                   => 'De geselecteerde :attribute is ongeldig.',
    'in_array'             => 'Het :attribute veld bestaat niet in :other.',
    'integer'              => 'Het :attribute moet een geheel getal zijn.',
    'ip'                   => 'Het :attribute moet een geldige zijn IP address.',
    'ipv4'                 => 'Het :attribute moet een geldige zijn IPv4 address.',
    'ipv6'                 => 'Het :attribute moet een geldige zijn IPv6 address.',
    'json'                 => 'Het :attribute moet een geldige zijn JSON string.',
    'lt'                   => [
        'numeric' => 'Het :attribute moet kleiner zijn dan :value.',
        'file'    => 'Het :attribute moet kleiner zijn dan :value kilobytes.',
        'string'  => 'Het :attribute moet kleiner zijn dan :value characters.',
        'array'   => 'Het :attribute moet minder hebben dan :value items.',
    ],
    'lte'                  => [
        'numeric' => 'Het :attribute moet kleiner dan of gelijk zijn :value.',
        'file'    => 'Het :attribute moet kleiner dan of gelijk zijn :value kilobytes.',
        'string'  => 'Het :attribute moet kleiner dan of gelijk zijn :value characters.',
        'array'   => 'Het :attribute mag niet meer hebben dan :value items.',
    ],
    'max'                  => [
        'numeric' => 'Het :attribute mag niet groter zijn dan :max.',
        'file'    => 'Het :attribute mag niet groter zijn dan :max kilobytes.',
        'string'  => 'Het :attribute mag niet groter zijn dan :max characters.',
        'array'   => 'Het :attribute mag niet meer hebben dan :max items.',
    ],
    'mimes'                => 'Het :attribute moet een bestand van het type zijn: :values.',
    'mimetypes'            => 'Het :attribute moet een bestand van het type zijn: :values.',
    'min'                  => [
        'numeric' => 'Het :attribute moet minstens zijn :min.',
        'file'    => 'Het :attribute moet minstens zijn :min kilobytes.',
        'string'  => 'Het :attribute moet minstens zijn :min characters.',
        'array'   => 'Het :attribute moet op zijn minst hebben :min items.',
    ],
    'not_in'               => 'De geselecteerde :attribute is ongeldig.',
    'not_regex'            => 'Het :attribute formaat is ongeldig.',
    'numeric'              => 'Het :attribute moet een nummer zijn.',
    'present'              => 'Het :attribute veld moet aanwezig zijn.',
    'regex'                => 'Het :attribute formaat is ongeldig.',
    'required'             => 'Het :attribute veld is verplicht.',
    'required_if'          => 'Het :attribute veld is vereist wanneer :other is :value.',
    'required_unless'      => 'Het :attribute veld is verplicht tenzij :other is in :values.',
    'required_with'        => 'Het :attribute veld is vereist wanneer :values is present.',
    'required_with_all'    => 'Het :attribute veld is vereist wanneer :values is present.',
    'required_without'     => 'Het :attribute veld is vereist wanneer :values is not present.',
    'required_without_all' => 'Het :attribute veld is verplicht wanneer geen van :values zijn aanwezig.',
    'same'                 => 'Het :attribute en :andere moeten overeenkomen.',
    'size'                 => [
        'numeric' => 'Het :attribute moet zijn :size.',
        'file'    => 'Het :attribute moet zijn :size kilobytes.',
        'string'  => 'Het :attribute moet zijn :size characters.',
        'array'   => 'Het :attribute moet bevatten :size items.',
    ],
    'string'               => 'Het :attribute moet een tekenreeks zijn.',
    'timezone'             => 'Het :attribute moet een geldige zone zijn.',
    'unique'               => 'Het :attribute is al bezet.',
    'uploaded'             => 'Het :attribute kan niet uploaden.',
    'url'                  => 'Het :attribute formaat is ongeldig.',

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
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
