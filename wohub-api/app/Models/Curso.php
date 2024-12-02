<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Curso extends Model
{
    use HasFactory;

    protected $table = 'cursos';
    public $timestamps = true;

    protected $fillable = ['titulo', 'descricao', 'categoria', 'link', 'foto', 'usuarios_id'];

    /**
     * @return BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuarios_id');
    }

    public function getFotoAttribute($value)
    {
        return !empty($value) ? $value : "curso1.png";
    }

    protected static function boot()
    {
        parent::boot();

        // Add logic to validate and preprocess the 'link' field before creating
        static::creating(function ($artigo) {
            $artigo->link = self::formatLink($artigo->link);
        });
    }

    /**
     * Format the link by ensuring it is a valid URL with a protocol.
     *
     * @param string $link
     * @return string
     */
    private static function formatLink($link)
    {
        if (empty($link)) {
            return $link;
        }

        // Check if the link starts with http:// or https://
        if (preg_match('/^(http:\/\/|https:\/\/)/i', $link)) {
            return $link; // Already has a valid protocol
        }

        // Check if the link starts with www.
        if (preg_match('/^www\./i', $link)) {
            return "http://{$link}";
        }

        // Default to adding http:// if no protocol is present
        return "http://{$link}";
    }
}
