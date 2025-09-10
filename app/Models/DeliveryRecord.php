<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeliveryRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'delivery_id',
        'participant_id',
        'status',
        'delivered_at',
        'document_verified',
        'observations',
        'delivered_by',
        'medical_certificate_expiry'
    ];

    protected $casts = [
        'delivered_at' => 'datetime',
        'medical_certificate_expiry' => 'date'
    ];

    /**
     * Relacionamento com a entrega
     */
    public function delivery(): BelongsTo
    {
        return $this->belongsTo(Delivery::class);
    }

    /**
     * Relacionamento com o participante
     */
    public function participant(): BelongsTo
    {
        return $this->belongsTo(Participant::class);
    }

    /**
     * Relacionamento com o usuário que entregou
     */
    public function deliveredBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'delivered_by');
    }

    /**
     * Scope para registros de uma entrega específica
     */
    public function scopeForDelivery($query, $deliveryId)
    {
        return $query->where('delivery_id', $deliveryId);
    }

    /**
     * Scope para registros de um participante específico
     */
    public function scopeForParticipant($query, $participantId)
    {
        return $query->where('participant_id', $participantId);
    }

    /**
     * Scope para registros de hoje
     */
    public function scopeToday($query)
    {
        return $query->whereDate('delivered_at', today());
    }

    /**
     * Verifica se o atestado médico ainda está válido
     */
    public function hasMedicalCertificateValid(): bool
    {
        return $this->status === 'excused' 
            && $this->medical_certificate_expiry 
            && $this->medical_certificate_expiry->isFuture();
    }

    /**
     * Retorna os dias restantes de validade do atestado
     */
    public function getMedicalCertificateRemainingDays(): ?int
    {
        if (!$this->medical_certificate_expiry) {
            return null;
        }

        return now()->diffInDays($this->medical_certificate_expiry, false);
    }
}
