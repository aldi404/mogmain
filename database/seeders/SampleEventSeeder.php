<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\RegistrationForm;
use App\Models\RegistrationFormField;
use Carbon\Carbon;

class SampleEventSeeder extends Seeder
{
    public function run()
    {
        // Update existing events to published if they're draft
        Event::where('status', 'draft')->update(['status' => 'published']);

        // Update event dates to future if they're in the past
        Event::where('event_date', '<', now())->update([
            'event_date' => Carbon::now()->addDays(30)
        ]);

        // Update registration forms to have proper dates
        RegistrationForm::where('registration_end', '<', now())->update([
            'registration_start' => Carbon::now(),
            'registration_end' => Carbon::now()->addDays(25),
            'is_active' => true
        ]);

        // Create a sample event if no events exist
        if (Event::count() === 0) {
            $event = Event::create([
                'title' => 'MOGMAIN Running Competition 2024',
                'description' => 'Join our exciting running competition with various categories for all ages.',
                'event_date' => Carbon::now()->addDays(30),
                'location' => 'Surabaya Sports Center',
                'event_type' => 'running',
                'max_participants' => 500,
                'registration_fee' => 150000,
                'status' => 'published',
                'created_by' => 1
            ]);

            $form = RegistrationForm::create([
                'event_id' => $event->id,
                'form_title' => 'Running Competition Registration',
                'form_description' => 'Please fill out this form to register for the running competition.',
                'is_active' => true,
                'registration_start' => Carbon::now(),
                'registration_end' => Carbon::now()->addDays(25),
            ]);

            // Add basic form fields
            $systemFields = [1, 2]; // name, email
            foreach ($systemFields as $index => $fieldId) {
                RegistrationFormField::create([
                    'registration_form_id' => $form->id,
                    'form_field_id' => $fieldId,
                    'is_required' => true,
                    'field_order' => $index + 1,
                ]);
            }
        }
    }
}
