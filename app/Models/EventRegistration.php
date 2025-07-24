<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_form_id',
        'participant_data',
        'status',
        'admin_notes',
        'approved',
        'transfer_receipt',
        'invoice',
        'processed_by',
        'processed_at'
    ];

    protected $casts = [
        'participant_data' => 'array',
        'processed_at' => 'datetime'
    ];

    public function registrationForm()
    {
        return $this->belongsTo(RegistrationForm::class);
    }

    public function processor()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    public function getParticipantName()
    {
        return $this->participant_data['name'] ?? 'N/A';
    }

    public function getParticipantEmail()
    {
        return $this->participant_data['email'] ?? 'N/A';
    }
}
