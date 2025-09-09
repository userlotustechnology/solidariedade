<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'delivery_date',
        'start_time',
        'end_time',
        'description',
        'total_baskets',
        'delivered_baskets',
        'status',
        'observations',
        'created_by'
    ];

    protected $casts = [
        'delivery_date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'total_baskets' => 'integer',
        'delivered_baskets' => 'integer'
    ];

    /**
     * Relacionamento com o usuário que criou
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relacionamento com os registros de entrega
     */
    public function deliveryRecords(): HasMany
    {
        return $this->hasMany(DeliveryRecord::class);
    }

    /**
     * Participantes que receberam cestas nesta entrega
     */
    public function participants()
    {
        return $this->belongsToMany(Participant::class, 'delivery_records')
            ->withPivot(['delivered_at', 'document_verified', 'observations', 'delivered_by'])
            ->withTimestamps();
    }

    /**
     * Atualiza o contador de cestas entregues
     */
    public function updateDeliveredCount(): void
    {
        $this->update([
            'delivered_baskets' => $this->deliveryRecords()->count()
        ]);
    }

    /**
     * Calcula a porcentagem de entregas realizadas
     */
    public function getDeliveryPercentageAttribute(): float
    {
        if ($this->total_baskets <= 0) {
            return 0;
        }
        return round(($this->delivered_baskets / $this->total_baskets) * 100, 2);
    }

    /**
     * Verifica se a entrega está em andamento hoje
     */
    public function getIsActiveAttribute(): bool
    {
        return $this->delivery_date->isToday() && $this->status === 'in_progress';
    }

    /**
     * Scopes
     */
    public function scopeUpcoming($query)
    {
        return $query->where('delivery_date', '>=', now()->toDateString())
                    ->where('status', '!=', 'cancelled');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Calcula o último sábado do mês
     */
    public static function getLastSaturdayOfMonth($year, $month): Carbon
    {
        $lastDay = Carbon::create($year, $month)->endOfMonth();

        // Se o último dia não é sábado, volta para o sábado anterior
        while ($lastDay->dayOfWeek !== Carbon::SATURDAY) {
            $lastDay->subDay();
        }

        return $lastDay;
    }

    /**
     * Gera título automático baseado na data
     */
    public static function generateTitle(Carbon $date): string
    {
        return 'Entrega de ' . $date->locale('pt_BR')->isoFormat('MMMM [de] YYYY');
    }
}
