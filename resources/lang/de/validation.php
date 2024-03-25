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

    'accepted'             => 'Le champs :attribute doit être acceptée.',
    'active_url'           => 'Le champs :attribute n est pas une URL valable.',
    'after'                => 'Le champs :attribute doit être une date après :date.',
    'after_or_equal'       => 'Le champs :attribute doit être une date égale ou postérieure à :date.',
    'alpha'                => 'Le champs attribute ne peut contenir que des lettres.',
    'alpha_dash'           => 'Le champs attribute ne peut contenir que des lettres, chiffres, tirets et caractères soulignés.',
    'alpha_num'            => 'Le champs attribute ne peut contenir que des lettres et des chiffres.',
    'array'                => 'Le champs attribute doit être une zone.',
    'before'               => 'Le champs attribute doit être une date avant :date.',
    'before_or_equal'      => 'Le champs attribute doit être une date égale ou antérieure à :date.',
    'between'              => [
        'numeric' => 'Le champs :attribute doit être entre :min and :max.',
        'file'    => 'Le champs :attribute doit être entre :min and :max kilobytes.',
        'string'  => 'Le champs :attribute doit être entre :min and :max characters.',
        'array'   => 'Le champs :attribute doit contenir entre :min and :max items.',
    ],
    'boolean'              => 'Le champs :attribute doit être juste ou faux.',
    'confirmed'            => 'Le champs :attribute de confirmation ne correspond pas.',
    'date'                 => 'Le champs :attribute n est pas une date valable.',
    'date_format'          => 'Le champs :attribute n a pas le bon format :format.',
    'different'            => 'Le :champs attribute et :other doivent être differents.',
    'digits'               => 'Le champs :attribute doit être :digits digits.',
    'digits_between'       => 'Le champs :attribute doit être comprise entre  :min and :max digits.',
    'dimensions'           => 'Le champs :attribute contient un dimension d image incorrecte.',
    'distinct'             => 'Le :champs attribute contient un doublon.',
    'email'                => 'Le champs :attribute doit être une adresse email valable.',
    'exists'               => 'Le champs :attribute n est pas valable.',
    'file'                 => 'Le champs :attribute doit être un fichier.',
    'filled'               => 'Le champs :attribute doit contenir une valeur.',
    'gt'                   => [
        'numeric' => 'Le champs :attribute doit être supérieur à :value.',
        'file'    => 'Le champs :attribute doit être supérieur à :value kilobytes.',
        'string'  => 'Le champs :attribute doit être supérieur à :value characters.',
        'array'   => 'Le champs :entrée doit avoir plus de :value items.',
    ],
    'gte'                  => [
        'numeric' => 'Le champs :attribute doit être supérieur ou égal à :value.',
        'file'    => 'Le champs :attribute doit être supérieur ou égal à :value kilobytes.',
        'string'  => 'Le champs :attribute doit être supérieur ou égal à :value characters.',
        'array'   => 'Le champs :attribute doit avoir :value items or more.',
    ],
    'image'                => 'Le champs :attribute doit être une image.',
    'in'                   => 'Le champs :attribute is invalid.',
    'in_array'             => 'Le champs :attribute n existe pas dans in :other.',
    'integer'              => 'Le champs :attribute doit être une  integer.',
    'ip'                   => 'Le champs :attribute doit être une valable IP address.',
    'ipv4'                 => 'Le champs :attribute doit être une valable IPv4 address.',
    'ipv6'                 => 'Le champs :attribute doit être une valable IPv6 address.',
    'json'                 => 'Le champs :attribute doit être une valable JSON string.',
    'lt'                   => [
        'numeric' => 'Le champs :attribute doit être inférieure à :value.',
        'file'    => 'Le champs :attribute doit être inférieur à :value kilobytes.',
        'string'  => 'Le champs :attribute doit être inférieur à :value characters.',
        'array'   => 'Le champs :attribute doit être moins que :value items.',
    ],
    'lte'                  => [
        'numeric' => 'Le champs :attribute doit être inférieur ou égal à :value.',
        'file'    => 'Le champs :attribute doit être inférieur ou égal à :value kilobytes.',
        'string'  => 'Le champs :attribute doit être inférieur ou égal à :value characters.',
        'array'   => 'Le champs :attribute ne peut pas contenir plus de :value items.',
    ],
    'max'                  => [
        'numeric' => 'Le champs :attribute ne peut être supérieur à :max.',
        'file'    => 'Le champs :attribute ne peut être supérieur à :max kilobytes.',
        'string'  => 'Le champs :attribute ne peut être supérieur à :max characters.',
        'array'   => 'Le champs :attribute ne peut contenir plus de :max items.',
    ],
    'mimes'                => 'Le champs :attribute doit être un fichier de type: :values.',
    'mimetypes'            => 'Le champs :attribute doit être un fichier de type: :values.',
    'min'                  => [
        'numeric' => 'Le champs :attribute doit avoir au moins :min.',
        'file'    => 'Le champs :attribute doit avoir au moins :min kilobytes.',
        'string'  => 'Le champs :attribute doit avoir au moins :min characters.',
        'array'   => 'Le champs :attribute doit avoir au moins :min items.',
    ],
    'not_in'               => 'Le champs :attribute selectionné n est pas valable.',
    'not_regex'            => 'Lehamps :attribute format d entrée n est pas valable.',
    'numeric'              => 'Le champs :attribute doit être un nombre.',
    'present'              => 'Le champs :attribute doit être présent.',
    'regex'                => 'Le champs :attribute format d entrée n est pas valable.',
    'required'             => 'Le champs :attribute est requis.',
    'required_if'          => 'Le champs :attribute est requis lorsque :other is :value.',
    'required_unless'      => 'Le champs :attribute est requis à moins que :other is in :values.',
    'required_with'        => 'Le champs :attribute est requis lorsque :values is present.',
    'required_with_all'    => 'Le champs :attribute est requis lorsque :values is present.',
    'required_without'     => 'Le champs :attribute est requis lorsque :valeur n est pas presente.',
    'required_without_all' => 'Le champs :attribute est requis, en l absence :values are present.',
    'same'                 => 'Le champs :attribute et :other doivent être égaux.',
    'size'                 => [
        'numeric' => 'Le champs :attribute doit être :size.',
        'file'    => 'Le champs :attribute doit être :size kilobytes.',
        'string'  => 'Le champs :attribute doit être :size characters.',
        'array'   => 'Le champs :attribute doit contenir :size items.',
    ],
    'string'               => 'Le champs :attribute doit être a string.',
    'timezone'             => 'Le champs :attribute doit être une zone valable.',
    'unique'               => 'Le champs :attribute a déjà été utilisée.',
    'uploaded'             => 'Le  :attribute upload à échoué.',
    'url'                  => 'Le :format attribute n est pas valable.',

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
