<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class InsertSampleData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Insert Users
        DB::table('usuarios')->insert([
            [
                'id' => 1,
                'nome' => 'Everton Rufino',
                'email' => 'everton7ej@gmail.com',
                'password' => '$2y$12$Np6v/LdgjM8MhowqRQ21q.cicHAbqKspWWsmY62UQ2DSASy0830kq',
                'created_at' => '2024-10-30 12:19:43',
                'tipo_usuario' => 2,
                'foto' => 'veve.jpg',
                'cargo' => 'Fullstack',
            ],
            [
                'id' => 2,
                'nome' => 'Wallace Melo',
                'email' => 'matue@gmail.com',
                'password' => '$2y$12$Np6v/LdgjM8MhowqRQ21q.cicHAbqKspWWsmY62UQ2DSASy0830kq',
                'created_at' => '2024-10-30 12:19:43',
                'tipo_usuario' => 2,
                'foto' => 'matue.jpg',
                'cargo' => 'Web-designer',
            ],
        ]);

        // Insert Courses
        DB::table('cursos')->insert([
            ['id' => 1, 'titulo' => 'Introdução ao Python', 'descricao' => 'Aprenda os fundamentos da programação em Python, ideal para iniciantes.', 'categoria' => 'Programação', 'link' => 'https://exemplo.com/curso-python', 'foto' => 'curso1.png', 'usuarios_id' => 2],
            ['id' => 2, 'titulo' => 'Bootcamp de Desenvolvimento Web', 'descricao' => 'Curso completo de HTML, CSS e JavaScript para criação de sites.', 'categoria' => 'Desenvolvimento Web', 'link' => 'https://exemplo.com/bootcamp-web', 'foto' => 'curso2.png', 'usuarios_id' => 2],
            ['id' => 3, 'titulo' => 'Dominando Vue.js', 'descricao' => 'Aprofunde-se na construção de aplicações escaláveis com React.js.', 'categoria' => 'Desenvolvimento Frontend', 'link' => 'https://exemplo.com/react-avancado', 'foto' => 'curso3.png', 'usuarios_id' => 1],
            ['id' => 4, 'titulo' => 'Desenvolvimento Full-Stack', 'descricao' => 'Aprenda a criar aplicações completas com Node.js e MongoDB.', 'categoria' => 'Full Stack', 'link' => 'https://exemplo.com/curso-fullstack', 'foto' => 'curso4.png', 'usuarios_id' => 1],
            ['id' => 5, 'titulo' => 'Introdução ao Machine Learning', 'descricao' => 'Entenda os conceitos básicos de aprendizado de máquina e suas aplicações.', 'categoria' => 'Ciência de Dados', 'link' => 'https://exemplo.com/ml-introducao', 'foto' => 'curso2.png', 'usuarios_id' => 2],
        ]);

        // Insert Events
        DB::table('eventos')->insert([
            [
                'id' => 1,
                'foto' => 'curso2.png',
                'titulo' => 'Inteligência Artificial na Prática',
                'descricao' => 'Explorando como IA pode transformar negócios.',
                'categoria' => 'IA',
                'link' => 'http://exemplo.com/ia-na-pratica',
                'tipo_evento' => 'palestra',
                'usuarios_id' => 2,
                'data_evento' => '2024-12-01 10:00:00'  // Added date and time for the event
            ],
            [
                'id' => 2,
                'foto' => 'curso1.png',
                'titulo' => 'Desenvolvimento Web Moderno',
                'descricao' => 'Workshop prático sobre as ferramentas e frameworks mais recentes.',
                'categoria' => 'Web Dev',
                'link' => 'http://exemplo.com/web-moderno',
                'tipo_evento' => 'workshop',
                'usuarios_id' => 1,
                'data_evento' => '2024-12-05 14:00:00'  // Added date and time for the event
            ],
            [
                'id' => 3,
                'foto' => 'inovation.jpg',
                'titulo' => 'Hackathon de Soluções Sustentáveis',
                'descricao' => 'Maratona de inovação focada em criar tecnologias sustentáveis.',
                'categoria' => 'Sustentabilidade',
                'link' => 'http://exemplo.com/hackathon-sustentavel',
                'tipo_evento' => 'hackathon',
                'usuarios_id' => 2,
                'data_evento' => '2024-12-10 08:00:00'  // Added date and time for the event
            ],
            [
                'id' => 4,
                'foto' => 'curso2.png',
                'titulo' => 'Segurança Cibernética em 2024',
                'descricao' => 'Entenda as novas ameaças e como se proteger.',
                'categoria' => 'Cybersec',
                'link' => 'http://exemplo.com/ciberseguranca-2024',
                'tipo_evento' => 'palestra',
                'usuarios_id' => 1,
                'data_evento' => '2024-12-15 09:00:00'  // Added date and time for the event
            ],
            [
                'id' => 5,
                'foto' => 'curso2.png',
                'titulo' => 'Introdução ao Machine Learning',
                'descricao' => 'Workshop sobre conceitos básicos e aplicações práticas.',
                'categoria' => 'IA',
                'link' => 'http://exemplo.com/ml-basico',
                'tipo_evento' => 'workshop',
                'usuarios_id' => 2,
                'data_evento' => '2024-12-20 11:00:00'  // Added date and time for the event
            ],
        ]);


        // Insert Articles
        DB::table('artigos')->insert([
            [
                'id' => 1,
                'titulo' => 'Artigo de IA',
                'descricao_curta' => 'Vamos perguntar ao GPT?',
                'descricao' => '<article> <h1>Os Robôs irão dominar tudo?</h1> <img src="https://www.google.com.br/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png" alt="Logo do Google"> <p style="color: red;">Não, não irão!</p> <p><a href="#">Saiba mais</a></p> <h5>Até a próxima pessoal!</h5></article>',
                'categoria' => 'I.A',
                'link' => 'https://google.com.br',
                'foto' => 'https://www.google.com.br/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png',
                'usuarios_id' => 2,
                'created_at' => '2024-10-30 12:43:31',
                'updated_at' => NULL
            ],
            [
                'id' => 2,
                'titulo' => 'O Futuro das Redes Sociais',
                'descricao_curta' => 'Muitos andam falando por aí...',
                'descricao' => '<article> <h1>O Futuro das Redes Sociais</h1> <img src="https://static.xx.fbcdn.net/rsrc.php/y1/r/4lCu2zih0ca.svg" alt="Logo do Facebook"> <p style="color: blue;">As redes sociais continuam a evoluir!</p> <p><a href="https://www.facebook.com/">Saiba mais</a></p> <h5>Nos vemos nas redes sociais!</h5></article>',
                'categoria' => 'Tecnologia',
                'link' => 'https://www.facebook.com/',
                'foto' => 'https://static.xx.fbcdn.net/rsrc.php/y1/r/4lCu2zih0ca.svg',
                'usuarios_id' => 2,
                'created_at' => '2024-10-30 12:43:31',
                'updated_at' => NULL
            ],
            [
                'id' => 3,
                'titulo' => 'Inovação no Porto Digital',
                'descricao_curta' => 'Sempre inovando!',
                'descricao' => '<article> <h1>Inovação no Porto Digital</h1> <img src="https://upload.wikimedia.org/wikipedia/commons/b/bc/Marca_Porto_Digital_2019_completa.png" alt="Logo do Porto Digital"> <p style="color: green;">O Porto Digital é um polo de inovação no Brasil.</p> <p><a href="https://www.portodigital.org/">Saiba mais</a></p> <h5>Inovando para o futuro!</h5></article>',
                'categoria' => 'Inovação',
                'link' => 'https://www.portodigital.org/',
                'foto' => 'https://upload.wikimedia.org/wikipedia/commons/b/bc/Marca_Porto_Digital_2019_completa.png',
                'usuarios_id' => 1,
                'created_at' => '2024-10-30 12:43:31',
                'updated_at' => NULL
            ]
        ]);

        // Insert Comments
        DB::table('comentarios')->insert([
            ['id' => 1, 'usuarios_id' => 2, 'created_at' => '2024-10-30 12:43:31', 'texto' => 'Odiei', 'artigos_id' => 1],
            ['id' => 2, 'usuarios_id' => 1, 'created_at' => '2024-10-30 12:43:31', 'texto' => 'Quem?', 'artigos_id' => 1],
            ['id' => 3, 'usuarios_id' => 2, 'created_at' => '2024-10-30 12:43:31', 'texto' => 'Quem oq?', 'artigos_id' => 1],
            ['id' => 4, 'usuarios_id' => 1, 'created_at' => '2024-10-30 12:43:31', 'texto' => 'Perguntou?', 'artigos_id' => 1],
        ]);

        // Insert Enrollments
        DB::table('inscricoes')->insert([
            ['id' => 1, 'usuarios_id' => 1, 'eventos_id' => 2, 'created_at' => '2024-11-25 00:00:00'],
            ['id' => 2, 'usuarios_id' => 1, 'eventos_id' => 1, 'created_at' => '2024-11-25 23:54:49'],
            ['id' => 3, 'usuarios_id' => 2, 'eventos_id' => 1, 'created_at' => '2024-11-26 23:54:49'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // No need to rollback data; only schema changes are normally reverted
    }
}
