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
        'transfer_receipt',
        'data_approved',
        'payment_approved',
        'invoice_number',
        'data_approved_at',
        'payment_approved_at',
        'data_approved_by',
        'payment_approved_by',
        'rejection_reason',
        'payment_rejection_reason'
    ];

    protected $casts = [
        'participant_data' => 'array',
        'data_approved' => 'boolean',
        'payment_approved' => 'boolean',
        'data_approved_at' => 'datetime',
        'payment_approved_at' => 'datetime'
    ];

    public function registrationForm()
    {
        return $this->belongsTo(RegistrationForm::class);
    }

    public function dataApprovedBy()
    {
        return $this->belongsTo(User::class, 'data_approved_by');
    }

    public function paymentApprovedBy()
    {
        return $this->belongsTo(User::class, 'payment_approved_by');
    }

    public function processor()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    public function getParticipantName()
    {
        if (isset($this->participant_data['name'])) {
            return $this->participant_data['name'];
        }

        if (isset($this->participant_data['nama_sekolah'])) {
            return $this->participant_data['nama_sekolah'];
        }

        if (isset($this->participant_data['manager_nama'])) {
            return $this->participant_data['manager_nama'];
        }

        return 'Unknown Participant';
    }

    public function getParticipantEmail()
    {
        if (isset($this->participant_data['email'])) {
            return $this->participant_data['email'];
        }

        if (isset($this->participant_data['manager_email'])) {
            return $this->participant_data['manager_email'];
        }

        if (isset($this->participant_data['contact_email'])) {
            return $this->participant_data['contact_email'];
        }

        return 'No Email';
    }

    public function getStatusLabelAttribute()
    {
        // Debug: pastikan data_approved di-cast sebagai boolean
        $dataApproved = (bool) $this->data_approved;
        $paymentApproved = (bool) $this->payment_approved;
        $hasTransferReceipt = !empty($this->transfer_receipt);

        if (!$dataApproved) {
            return 'Menunggu Verifikasi Data';
        }

        if ($dataApproved && !$paymentApproved && !$hasTransferReceipt) {
            return 'Menunggu Upload Bukti Transfer';
        }

        if ($dataApproved && !$paymentApproved && $hasTransferReceipt) {
            return 'Menunggu Verifikasi Pembayaran';
        }

        if ($dataApproved && $paymentApproved) {
            return 'Terdaftar';
        }

        return 'Pending';
    }

    public function generateInvoiceNumber()
    {
        if (!$this->invoice_number) {
            $prefix = 'INV';
            $date = now()->format('Ymd');
            $sequence = str_pad($this->id, 4, '0', STR_PAD_LEFT);
            $this->invoice_number = "{$prefix}-{$date}-{$sequence}";
            $this->save();
        }
        return $this->invoice_number;
    }
}
