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
}
