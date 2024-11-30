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

    protected $fillable = ['titulo', 'descricao', 'categoria', 'link', 'foto'];

    /**
     * @return BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuarios_id');
    }
}
