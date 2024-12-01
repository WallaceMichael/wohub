<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Evento extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'eventos';
    protected $fillable = ['foto', 'titulo', 'descricao', 'categoria', 'link', 'tipo_evento', 'data_evento', 'usuarios_id'];

    public function inscricoes()
    {
        return $this->hasMany(Inscricao::class, 'eventos_id');
    }

    /**
     * @return BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuarios_id');
    }

    public function getTipoEventoAttribute($value)
    {
        return ucfirst($value);
    }

    public function getFotoAttribute($value)
    {
        return !empty($value) ? $value : "curso2.png";
    }

}
