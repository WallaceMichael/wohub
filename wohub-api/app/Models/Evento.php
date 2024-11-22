<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'eventos';

    protected $fillable = ['foto', 'titulo', 'descricao', 'categoria', 'link', 'tipo_evento'];

    // Relacionamento: Um evento tem muitas inscrições
    public function inscricoes()
    {
        return $this->hasMany(Inscricao::class, 'eventos_id');
    }
}
