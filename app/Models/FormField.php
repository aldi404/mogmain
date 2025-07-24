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
}
