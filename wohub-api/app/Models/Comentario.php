<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $table = 'comentarios';

    protected $fillable = ['texto', 'usuario_id', 'artigos_id'];

    // Relacionamento: Um comentário pertence a um artigo
    public function artigo()
    {
        return $this->belongsTo(Artigo::class, 'artigos_id');
    }

    // Relacionamento: Um comentário pertence a um usuário
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
