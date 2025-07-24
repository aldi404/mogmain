<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationFormField extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_form_id',
        'form_field_id',
        'is_required',
        'field_order',
        'custom_label',
        'custom_validation'
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'custom_validation' => 'array'
    ];

    public function registrationForm()
    {
        return $this->belongsTo(RegistrationForm::class);
    }

    public function formField()
    {
        return $this->belongsTo(FormField::class);
    }

    public function getDisplayLabel()
    {
        return $this->custom_label ?: $this->formField->field_label;
    }

    public function getValidationRules()
    {
        return $this->custom_validation ?: $this->formField->validation_rules;
    }
}
