<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasFactory;
    use HasApiTokens;

    protected $table = 'usuarios';

    protected $fillable = ['nome', 'email', 'password', 'foto', 'tipo_usuario'];
    public $timestamps = false;
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getAuthIdentifierName()
    {
        return 'id';
    }


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
