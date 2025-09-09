<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'document_type',
        'document_number',
        'birth_date',
        'phone',
        'email',
        'address',
        'address_complement',
        'neighborhood',
        'city',
        'state',
        'zip_code',
        'gender',
        'marital_status',
        'family_members',
        'monthly_income',
        'receives_government_benefit',
        'government_benefit_type',
        'employment_status',
        'workplace',
        'has_documents',
        'observations',
        'active',
        'registered_at',
        'registered_by'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'monthly_income' => 'decimal:2',
        'active' => 'boolean',
        'receives_government_benefit' => 'boolean',
        'has_documents' => 'boolean',
        'registered_at' => 'datetime',
        'family_members' => 'integer'
    ];

    /**
     * Accessor para formatar o telefone na exibição
     */
    public function getFormattedPhoneAttribute()
    {
        if (!$this->phone) {
            return null;
        }

        $phone = preg_replace('/\D/', '', $this->phone);
        $length = strlen($phone);

        if ($length === 11) {
            return '(' . substr($phone, 0, 2) . ') ' . substr($phone, 2, 5) . '-' . substr($phone, 7);
        }

        if ($length === 10) {
            return '(' . substr($phone, 0, 2) . ') ' . substr($phone, 2, 4) . '-' . substr($phone, 6);
        }

        return $this->phone;
    }

    /**
     * Mutator para limpar o telefone antes de salvar
     */
    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = $value ? preg_replace('/\D/', '', $value) : null;
    }

    /**
     * Relacionamento com o usuário que registrou
     */
    public function registeredBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'registered_by');
    }

    /**
     * Relacionamento com os registros de entrega
     */
    public function deliveryRecords(): HasMany
    {
        return $this->hasMany(DeliveryRecord::class);
    }

    /**
     * Verifica se o participante recebeu cesta na entrega específica
     */
    public function hasReceivedBasket(Delivery $delivery): bool
    {
        return $this->deliveryRecords()
            ->where('delivery_id', $delivery->id)
            ->exists();
    }

    /**
     * Calcula a idade do participante
     */
    public function getAgeAttribute(): int
    {
        return $this->birth_date->age;
    }

    /**
     * Formata o documento
     */
    public function getFormattedDocumentAttribute(): string
    {
        if ($this->document_type === 'CPF') {
            return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $this->document_number);
        }
        return $this->document_number;
    }

    /**
     * Scope para participantes ativos
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Scope para busca por nome ou documento
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('document_number', 'like', "%{$search}%");
        });
    }
}
