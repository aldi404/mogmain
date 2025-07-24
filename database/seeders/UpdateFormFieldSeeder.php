<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FormField;

class UpdateFormFieldSeeder extends Seeder
{
    public function run()
    {
        // Update email field to not be system field and not required by default
        FormField::where('field_name', 'email')->update([
            'is_system_field' => false,
            'validation_rules' => ['email' => true] // remove required
        ]);

        // Ensure name field is still system field
        FormField::where('field_name', 'name')->update([
            'is_system_field' => true,
            'validation_rules' => ['required' => true, 'min' => 2, 'max' => 255]
        ]);
    }
}
