<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FormField;

class FormFieldSeeder extends Seeder
{
    public function run()
    {
        $formFields = [
            [
                'field_name' => 'name',
                'field_label' => 'Nama Lengkap',
                'field_type' => 'text',
                'validation_rules' => ['required' => true, 'min' => 2, 'max' => 255],
                'is_system_field' => true
            ],
            [
                'field_name' => 'email',
                'field_label' => 'Email',
                'field_type' => 'email',
                'validation_rules' => ['email' => true],
                'is_system_field' => false
            ],
            [
                'field_name' => 'phone',
                'field_label' => 'Nomor HP',
                'field_type' => 'tel',
                'validation_rules' => ['required' => false, 'regex' => '/^[0-9+\-\s]+$/']
            ],
            [
                'field_name' => 'company',
                'field_label' => 'Nama Perusahaan/Instansi',
                'field_type' => 'text',
                'validation_rules' => ['max' => 255]
            ],
            [
                'field_name' => 'identity_upload',
                'field_label' => 'Upload KTP/Identitas',
                'field_type' => 'file',
                'validation_rules' => ['mimes' => 'jpg,jpeg,png,pdf', 'max' => 2048]
            ],
            [
                'field_name' => 'payment_proof',
                'field_label' => 'Bukti Transfer',
                'field_type' => 'file',
                'validation_rules' => ['mimes' => 'jpg,jpeg,png,pdf', 'max' => 2048]
            ],
            [
                'field_name' => 'emergency_contact',
                'field_label' => 'Kontak Darurat',
                'field_type' => 'tel',
                'validation_rules' => ['regex' => '/^[0-9+\-\s]+$/']
            ],
            [
                'field_name' => 'birth_date',
                'field_label' => 'Tanggal Lahir',
                'field_type' => 'date',
                'validation_rules' => ['date' => true]
            ],
            [
                'field_name' => 'gender',
                'field_label' => 'Jenis Kelamin',
                'field_type' => 'select',
                'field_options' => ['Laki-laki', 'Perempuan'],
                'validation_rules' => ['in' => 'Laki-laki,Perempuan']
            ],
            [
                'field_name' => 'address',
                'field_label' => 'Alamat Lengkap',
                'field_type' => 'textarea',
                'validation_rules' => ['max' => 500]
            ],
            [
                'field_name' => 'message',
                'field_label' => 'Pesan/Catatan',
                'field_type' => 'textarea',
                'validation_rules' => ['max' => 1000]
            ]
        ];

        foreach ($formFields as $field) {
            FormField::create($field);
        }
    }
}
