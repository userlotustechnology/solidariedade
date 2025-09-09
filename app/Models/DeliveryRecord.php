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
        'delivered_by'
    ];

    protected $casts = [
        'delivered_at' => 'datetime'
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
}
