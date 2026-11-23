<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'registration_number',
        'full_name',
        'nik',
        'birth_place',
        'birth_date',
        'gender',
        'whatsapp',
        'address',
        'school_name',
        'nisn',
        'graduation_year',
        'faculty',
        'study_program',
        'is_under_17',
        'status',
        'confirmation_email_sent_at',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'is_under_17' => 'boolean',
            'confirmation_email_sent_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(ApplicationDocument::class);
    }

    public function getDocument(string $type): ?ApplicationDocument
    {
        return $this->documents->where('document_type', $type)->first();
    }

    public function getAgeAttribute(): ?int
    {
        if (!$this->birth_date) {
            return null;
        }
        return Carbon::parse($this->birth_date)->age;
    }

    public function getAgeFormattedAttribute(): string
    {
        if (!$this->birth_date) {
            return '-';
        }
        $diff = Carbon::parse($this->birth_date)->diff(Carbon::now());
        return "{$diff->y} Tahun {$diff->m} Bulan";
    }

    /**
     * Check if all required documents are verified and valid.
     * KK, Ijazah, Pas Foto are mandatory. KTP is required only if not under 17.
     */
    public function areRequiredDocumentsValid(): bool
    {
        $kk = $this->getDocument('kk');
        $ijazah = $this->getDocument('ijazah');
        $pasFoto = $this->getDocument('pas_foto');

        if (!$kk || !$kk->is_valid) {
            return false;
        }

        if (!$ijazah || !$ijazah->is_valid) {
            return false;
        }

        if (!$pasFoto || !$pasFoto->is_valid) {
            return false;
        }

        // KTP rule:
        if (!$this->is_under_17) {
            $ktp = $this->getDocument('ktp');
            if (!$ktp || !$ktp->is_valid) {
                return false;
            }
        }

        return true;
    }
}
