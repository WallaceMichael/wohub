<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = ['nome', 'email', 'senha', 'foto', 'tipo_usuario'];
    public $timestamps = false;


    // Relacionamento de um usuário para muitos artigos
    public function artigos()
    {
        return $this->hasMany(Artigo::class, 'usuarios_id');
    }

    // Relacionamento de um usuário para muitos comentários
    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'usuario_id');
    }

    // Relacionamento de um usuário para muitas inscrições
    public function inscricoes()
    {
        return $this->hasMany(Inscricao::class, 'usuarios_id');
    }
}
