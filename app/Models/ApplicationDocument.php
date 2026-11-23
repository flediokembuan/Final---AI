<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicationDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'document_type',
        'file_path',
        'original_filename',
        'is_valid',
        'ai_feedback_json',
    ];

    protected function casts(): array
    {
        return [
            'is_valid' => 'boolean',
            'ai_feedback_json' => 'array',
        ];
    }

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    public function getDocumentTypeLabelAttribute(): string
    {
        return match ($this->document_type) {
            'kk' => 'Kartu Keluarga (KK)',
            'ijazah' => 'Ijazah / SKL Legalisir',
            'pas_foto' => 'Pas Foto Formal',
            'ktp' => 'Kartu Tanda Penduduk (KTP)',
            default => strtoupper($this->document_type),
        };
    }
}
