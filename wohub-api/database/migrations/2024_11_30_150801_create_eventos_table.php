<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable();
            $table->string('titulo');
            $table->text('descricao_curta')->nullable();
            $table->text('descricao')->nullable();
            $table->string('categoria')->nullable();
            $table->string('link')->nullable();
            $table->enum('tipo_evento', ['palestra', 'workshop', 'hackathon'])->default('palestra');
            $table->foreignId('usuarios_id')->constrained('usuarios')->onDelete('cascade');
            $table->dateTime('data_evento')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventos');
    }
}
