<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    use HasFactory;

    protected $fillable = [
        'field_name',
        'field_label',
        'field_type',
        'field_options',
        'validation_rules',
        'is_system_field'
    ];

    protected $casts = [
        'field_options' => 'array',
        'validation_rules' => 'array',
        'is_system_field' => 'boolean'
    ];

    public function registrationFormFields()
    {
        return $this->hasMany(RegistrationFormField::class);
    }

    public function getValidationRules()
    {
        $rules = [];

        // Special handling for phone number field (name field)
        if ($this->field_name === 'name') {
            $rules['numeric'] = true;
            $rules['min'] = 8;
            $rules['max'] = 14;
            $rules['regex'] = '/^[0-9]{8,14}$/'; // Only numbers, 8-14 digits
            return $rules;
        }

        return $rules;
    }
}
