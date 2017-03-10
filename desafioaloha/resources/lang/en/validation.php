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

    'accepted'             => 'O campo :attribute deve ser reconhecido.',
    'active_url'           => 'O campo :attribute não é uma URL válida.',
    'after'                => 'O campo :attribute deve ser uma data depois de :date.',
    'alpha'                => 'O campo :attribute só pode conter letras.',
    'alpha_dash'           => 'O campo :attribute só pode conter letras, números e hífen.',
    'alpha_num'            => 'O campo :attribute só pode conter letras e números.',
    'array'                => 'O campo :attribute deve ser um array (conjunto).',
    'before'               => 'O campo :attribute deve ser uma data antes de :date.',
    'between'              => [
        'numeric' => 'O campo :attribute deve estar entre :min e :max.',
        'file'    => 'O campo :attribute deve estar entre :min e :max kilobytes.',
        'string'  => 'O campo :attribute deve estar entre :min e :max de caracteres.',
        'array'   => 'O campo :attribute deve estar entre :min e :max de itens.',
    ],
    'boolean'              => 'O campo :attribute deve ser verdadeiro ou falso.',
    'confirmed'            => 'O campo :attribute confirmação não combina.',
    'date'                 => 'O campo :attribute não é uma data válida.',
    'date_format'          => 'O campo :attribute não combina com o formato :format.',
    'different'            => 'O campo :attribute e :other deve ser diferente.',
    'digits'               => 'O campo :attribute deve ter :digits de dígitos.',
    'digits_between'       => 'O campo :attribute deve estar entre :min e :max de dígitos.',
    'email'                => 'O campo :attribute deve ser um endereço de email válido.',
    'exists'               => 'O campo selecionado :attribute é inválido.',
    'filled'               => 'O campo :attribute é requirido.',
    'image'                => 'O campo :attribute deve ser uma imagem.',
    'in'                   => 'O campo :attribute selecionado é inválido.',
    'integer'              => 'O campo :attribute deve ser um inteiro.',
    'ip'                   => 'O campo :attribute deve ser um endereço de IP válido.',
    'json'                 => 'O campo :attribute deve ser um objeto JSON válido.',
    'max'                  => [
        'numeric' => 'O campo :attribute não deve ser maior do que :max.',
        'file'    => 'O campo :attribute não deve ser maior do que :max de kilobytes.',
        'string'  => 'O campo :attribute não deve ser maior do que :max .',
        'array'   => 'O campo :attribute não deve ter mais do que :max de itens.',
    ],
    'mimes'                => 'O campo :attribute deve ser um arquivo do tipo: :values.',
    'min'                  => [
        'numeric' => 'O campo :attribute deve ser no mínimo :min.',
        'file'    => 'O campo :attribute deve ser no mínimo :min kilobytes.',
        'string'  => 'O campo :attribute deve ser no mínimo :min caracteres.',
        'array'   => 'O campo :attribute deve ter no mínimo :min de itens.',
    ],
    'not_in'               => 'O campo :attribute selecionado é inválido.',
    'numeric'              => 'O campo :attribute deve ser um número.',
    'regex'                => 'O campo :attribute tem formato inválido.',
    'required'             => 'O campo :attribute é requerido.',
    'required_if'          => 'O campo :attribute é requerido quando :other é :value.',
    'required_unless'      => 'O campo :attribute é requerido a menos que :other está em :values.',
    'required_with'        => 'O campo :attribute é requerido quando :values está presente.',
    'required_with_all'    => 'O campo :attribute é requerido quando :values está presente.',
    'required_without'     => 'O campo :attribute é requerido quando :values não está presente.',
    'required_without_all' => 'O campo :attribute é requerido quando nenhum dos :values estão presentes.',
    'same'                 => 'O campo :attribute e :other deve combinar.',
    'size'                 => [
        'numeric' => 'O campo :attribute deve ser :size.',
        'file'    => 'O campo :attribute deve ter :size kilobytes.',
        'string'  => 'O campo :attribute deve ser :size caracteres.',
        'array'   => 'O campo :attribute deve conter :size itens.',
    ],
    'string'               => 'O campo :attribute deve ser uma string.',
    'timezone'             => 'O campo :attribute deve ser uma zona válida.',
    'unique'               => 'O campo :attribute já foi tomada.',
    'url'                  => 'O campo formato do :attribute é inválido.',

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
