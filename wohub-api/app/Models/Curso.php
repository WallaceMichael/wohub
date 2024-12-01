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
}
