<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormFieldSeeder extends Seeder
{
    public function run()
    {
        // Clear existing data (safer approach)
        DB::table('registration_form_fields')->delete(); // Clear child table first
        DB::table('form_fields')->delete(); // Then clear parent table

        // Regular Form Fields
        $fields = [
            // Informasi Sekolah
            [
                'field_name' => 'nama_sekolah',
                'field_label' => 'Nama Sekolah',
                'field_type' => 'text',
                'validation_rules' => json_encode(['required' => true, 'min' => 2, 'max' => 255]),
                'is_system_field' => false
            ],
            [
                'field_name' => 'logo_sekolah',
                'field_label' => 'Logo Sekolah',
                'field_type' => 'file',
                'validation_rules' => json_encode(['required' => true, 'mimes' => 'jpg,jpeg,png', 'max' => 2048]),
                'is_system_field' => false
            ],

            // Manager
            [
                'field_name' => 'manager_nama',
                'field_label' => 'Nama Lengkap (Manager)',
                'field_type' => 'text',
                'validation_rules' => json_encode(['required' => true, 'min' => 2, 'max' => 255]),
                'is_system_field' => false
            ],
            [
                'field_name' => 'manager_ttl',
                'field_label' => 'Tempat Tanggal Lahir (Manager)',
                'field_type' => 'text',
                'validation_rules' => json_encode(['required' => true]),
                'is_system_field' => false
            ],
            [
                'field_name' => 'manager_ktp',
                'field_label' => 'Foto KTP/Identitas (Manager)',
                'field_type' => 'file',
                'validation_rules' => json_encode(['required' => true, 'mimes' => 'jpg,jpeg,png,pdf', 'max' => 2048]),
                'is_system_field' => false
            ],

            // Head Coach
            [
                'field_name' => 'head_coach_nama',
                'field_label' => 'Nama Lengkap (Head Coach)',
                'field_type' => 'text',
                'validation_rules' => json_encode(['required' => true]),
                'is_system_field' => false
            ],
            [
                'field_name' => 'head_coach_ttl',
                'field_label' => 'Tempat Tanggal Lahir (Head Coach)',
                'field_type' => 'text',
                'validation_rules' => json_encode(['required' => true]),
                'is_system_field' => false
            ],
            [
                'field_name' => 'head_coach_ktp',
                'field_label' => 'Foto KTP/Identitas (Head Coach)',
                'field_type' => 'file',
                'validation_rules' => json_encode(['required' => true, 'mimes' => 'jpg,jpeg,png,pdf', 'max' => 2048]),
                'is_system_field' => false
            ],
            [
                'field_name' => 'head_coach_lisensi',
                'field_label' => 'Lisensi Pelatih (Minimal C)',
                'field_type' => 'file',
                'validation_rules' => json_encode(['required' => true, 'mimes' => 'jpg,jpeg,png,pdf', 'max' => 2048]),
                'is_system_field' => false
            ],

            // Asisten Coach
            [
                'field_name' => 'asisten_coach_nama',
                'field_label' => 'Nama Lengkap (Asisten Coach)',
                'field_type' => 'text',
                'validation_rules' => json_encode(['required' => true]),
                'is_system_field' => false
            ],
            [
                'field_name' => 'asisten_coach_ttl',
                'field_label' => 'Tempat Tanggal Lahir (Asisten Coach)',
                'field_type' => 'text',
                'validation_rules' => json_encode(['required' => true]),
                'is_system_field' => false
            ],
            [
                'field_name' => 'asisten_coach_ktp',
                'field_label' => 'Foto KTP/Identitas (Asisten Coach)',
                'field_type' => 'file',
                'validation_rules' => json_encode(['required' => true, 'mimes' => 'jpg,jpeg,png,pdf', 'max' => 2048]),
                'is_system_field' => false
            ],

            // Utility
            [
                'field_name' => 'utility_nama',
                'field_label' => 'Nama Lengkap (Utility)',
                'field_type' => 'text',
                'validation_rules' => json_encode(['required' => true]),
                'is_system_field' => false
            ],
            [
                'field_name' => 'utility_ttl',
                'field_label' => 'Tempat Tanggal Lahir (Utility)',
                'field_type' => 'text',
                'validation_rules' => json_encode(['required' => true]),
                'is_system_field' => false
            ],
            [
                'field_name' => 'utility_ktp',
                'field_label' => 'Foto KTP/Identitas (Utility)',
                'field_type' => 'file',
                'validation_rules' => json_encode(['required' => true, 'mimes' => 'jpg,jpeg,png,pdf', 'max' => 2048]),
                'is_system_field' => false
            ],

            // Repeatable Section Fields (untuk pemain)
            [
                'field_name' => 'nama_pemain',
                'field_label' => 'Nama Pemain',
                'field_type' => 'text',
                'validation_rules' => json_encode(['required' => true]),
                'is_system_field' => false
            ],
            [
                'field_name' => 'pemain_ttl',
                'field_label' => 'Tempat Tanggal Lahir',
                'field_type' => 'text',
                'validation_rules' => json_encode(['required' => true]),
                'is_system_field' => false
            ],
            [
                'field_name' => 'pemain_akte',
                'field_label' => 'Akte (Foto Asli)',
                'field_type' => 'file',
                'validation_rules' => json_encode(['required' => true, 'mimes' => 'jpg,jpeg,png,pdf', 'max' => 2048]),
                'is_system_field' => false
            ],
            [
                'field_name' => 'pemain_nisn',
                'field_label' => 'NISN/Sampul Raport',
                'field_type' => 'file',
                'validation_rules' => json_encode(['required' => true, 'mimes' => 'jpg,jpeg,png,pdf', 'max' => 2048]),
                'is_system_field' => false
            ],
            [
                'field_name' => 'nomor_jersey',
                'field_label' => 'Nomor Jersey',
                'field_type' => 'number',
                'validation_rules' => json_encode(['required' => true, 'numeric' => true]),
                'is_system_field' => false
            ],
            [
                'field_name' => 'posisi',
                'field_label' => 'Posisi',
                'field_type' => 'select',
                'field_options' => json_encode(['Point Guard', 'Shooting Guard', 'Small Forward', 'Power Forward', 'Center']),
                'validation_rules' => json_encode(['required' => true]),
                'is_system_field' => false
            ],
            [
                'field_name' => 'foto_pemain',
                'field_label' => 'Foto Pemain',
                'field_type' => 'file',
                'validation_rules' => json_encode(['required' => true, 'mimes' => 'jpg,jpeg,png', 'max' => 2048]),
                'is_system_field' => false
            ]
        ];

        // Insert fields dengan timestamps
        foreach ($fields as $field) {
            $field['created_at'] = now();
            $field['updated_at'] = now();
            DB::table('form_fields')->insert($field);
        }
    }
}
                'field_name' => 'nomor_jersey',
                'field_label' => 'Nomor Jersey',
                'field_type' => 'number',
                'validation_rules' => json_encode(['required' => true, 'numeric' => true]),
                'is_system_field' => false,  'field_name' => 'pemain_nisn',
                'is_active' => true,   'field_label' => 'NISN/Sampul Raport',
                'field_order' => 20
            ],e(['required' => true, 'mimes' => 'jpg,jpeg,png,pdf', 'max' => 2048]),
            [e,
                'field_name' => 'posisi',
                'field_label' => 'Posisi',
                'field_type' => 'select',
                'field_options' => json_encode(['Point Guard', 'Shooting Guard', 'Small Forward', 'Power Forward', 'Center']),
                'validation_rules' => json_encode(['required' => true]),  'field_name' => 'nomor_jersey',
                'is_system_field' => false,   'field_label' => 'Nomor Jersey',
                'is_active' => true,
                'field_order' => 21_encode(['required' => true, 'numeric' => true]),
            ],e,
            [
                'field_name' => 'foto_pemain',
                'field_label' => 'Foto Pemain',
                'field_type' => 'file',
                'validation_rules' => json_encode(['required' => true, 'mimes' => 'jpg,jpeg,png', 'max' => 2048]),sisi',
                'is_system_field' => false,  'field_label' => 'Posisi',
                'is_active' => true,   'field_type' => 'select',
                'field_order' => 22(['Point Guard', 'Shooting Guard', 'Small Forward', 'Power Forward', 'Center']),
            ]de(['required' => true]),
        ];lse,

        // Insert fields dengan timestamps
        foreach ($fields as $field) {
            $field['created_at'] = now();
            $field['updated_at'] = now();   'field_name' => 'foto_pemain',
            DB::table('form_fields')->insert($field);      'field_label' => 'Foto Pemain',
        }                'field_type' => 'file',
    }_encode(['required' => true, 'mimes' => 'jpg,jpeg,png', 'max' => 2048]),
}false,
                'is_active' => true,
                'field_order' => 22
            ]
        ];

        // Insert fields dengan timestamps
        foreach ($fields as $field) {
            $field['created_at'] = now();
            $field['updated_at'] = now();
            DB::table('form_fields')->insert($field);
        }
    }
}
