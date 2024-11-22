<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscricao extends Model
{
    use HasFactory;

    protected $table = 'inscricoes';

    protected $fillable = ['usuarios_id', 'eventos_id', 'data_inscricao'];

    // Relacionamento: Uma inscrição pertence a um usuário
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuarios_id');
    }

    // Relacionamento: Uma inscrição pertence a um evento
    public function evento()
    {
        return $this->belongsTo(Evento::class, 'eventos_id');
    }
}
