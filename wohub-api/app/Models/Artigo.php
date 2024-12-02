<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artigo extends Model
{
    use HasFactory;

    protected $table = 'artigos';
    public $timestamps = true;

    protected $fillable = ['titulo', 'descricao_curta', 'descricao', 'categoria', 'link', 'foto', 'usuarios_id'];

    // Relacionamento: Um artigo pertence a um usuário
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuarios_id');
    }

    // Relacionamento: Um artigo tem muitos comentários
    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'artigos_id');
    }

    public function getFotoAttribute($value)
    {
        return !empty($value) ? $value : "curso2.png";
    }

    /**
     * Boot method to handle model events.
     */
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
