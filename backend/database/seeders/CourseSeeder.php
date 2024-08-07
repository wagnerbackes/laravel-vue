<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            ['name' => 'Marketing Digital para Iniciantes', 'description' => 'Curso básico sobre estratégias de marketing digital.', 'status' => 'open'],
            ['name' => 'Desenvolvimento Web com PHP e Laravel', 'description' => 'Aprenda a desenvolver aplicações web usando PHP e Laravel.', 'status' => 'open'],
            ['name' => 'Gestão de Projetos Ágeis', 'description' => 'Introdução à gestão de projetos usando metodologias ágeis.', 'status' => 'open'],
            ['name' => 'Treinamento em Atendimento ao Cliente', 'description' => 'Melhore suas habilidades de atendimento ao cliente.', 'status' => 'open'],
            ['name' => 'SEO para E-commerce', 'description' => 'Otimização de sites para motores de busca com foco em e-commerce.', 'status' => 'open'],
            ['name' => 'Design de Interfaces de Usuário', 'description' => 'Principais conceitos de design para criar interfaces atraentes.', 'status' => 'open'],
            ['name' => 'Técnicas de Vendas e Negociação', 'description' => 'Desenvolva habilidades de vendas e técnicas de negociação.', 'status' => 'open'],
            ['name' => 'Desenvolvimento de Aplicativos Mobile', 'description' => 'Curso sobre desenvolvimento de apps para iOS e Android.', 'status' => 'open'],
            ['name' => 'Introdução ao Google Ads', 'description' => 'Aprenda a criar e gerenciar campanhas de anúncios no Google Ads.', 'status' => 'open'],
            ['name' => 'Treinamento em Excel Avançado', 'description' => 'Aprimore suas habilidades no Excel para uso corporativo.', 'status' => 'restricted'],
            ['name' => 'Gerenciamento de Redes Sociais', 'description' => 'Técnicas e estratégias para gerenciar redes sociais.', 'status' => 'open'],
            ['name' => 'Programação em JavaScript', 'description' => 'Curso completo sobre programação usando JavaScript.', 'status' => 'open'],
            ['name' => 'Inteligência Emocional no Trabalho', 'description' => 'Desenvolva habilidades de inteligência emocional no ambiente de trabalho.', 'status' => 'open'],
            ['name' => 'E-mail Marketing Eficaz', 'description' => 'Técnicas para criar campanhas de e-mail marketing eficazes.', 'status' => 'open'],
            ['name' => 'Treinamento em Gestão de Tempo', 'description' => 'Aprenda a gerenciar melhor seu tempo e aumentar sua produtividade.', 'status' => 'restricted'],
            ['name' => 'Análise de Dados para Negócios', 'description' => 'Utilize dados para tomar decisões empresariais mais informadas.', 'status' => 'open'],
            ['name' => 'UX Writing: Escrita para Interfaces', 'description' => 'Técnicas de escrita para melhorar a experiência do usuário.', 'status' => 'open'],
            ['name' => 'Marketing de Conteúdo', 'description' => 'Estratégias para criar e distribuir conteúdo relevante.', 'status' => 'open'],
            ['name' => 'Noções Básicas de Programação Python', 'description' => 'Introdução à programação usando a linguagem Python.', 'status' => 'open'],
            ['name' => 'Segurança da Informação para Empresas', 'description' => 'Princípios básicos de segurança da informação no ambiente corporativo.', 'status' => 'restricted'],
            ['name' => 'Técnicas de Apresentação e Oratória', 'description' => 'Desenvolva habilidades de apresentação e comunicação.', 'status' => 'open'],
            ['name' => 'Planejamento Estratégico', 'description' => 'Fundamentos de planejamento estratégico para negócios.', 'status' => 'open'],
            ['name' => 'Desenvolvimento de Liderança', 'description' => 'Capacitação para o desenvolvimento de habilidades de liderança.', 'status' => 'restricted'],
            ['name' => 'Branding: Construção de Marca', 'description' => 'Estratégias para criar e gerenciar uma marca forte.', 'status' => 'open'],
            ['name' => 'Análise de Métricas em Marketing Digital', 'description' => 'Como analisar e interpretar métricas de campanhas digitais.', 'status' => 'open'],
        ];

        foreach ($courses as $course) {
            Course::factory()->create($course);
        }
    }
}
