<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Topic;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Topic::insert([
            // Tópicos para "Marketing Digital para Iniciantes"
            ['course_id' => 1, 'name' => 'Introdução ao Marketing Digital', 'description' => 'Conceitos básicos e importância do marketing digital.'],
            ['course_id' => 1, 'name' => 'SEO e SEM', 'description' => 'Otimização para motores de busca e marketing de busca.'],
            ['course_id' => 1, 'name' => 'Redes Sociais', 'description' => 'Uso de plataformas de redes sociais para marketing.'],
            ['course_id' => 1, 'name' => 'E-mail Marketing', 'description' => 'Criação e gerenciamento de campanhas de e-mail.'],

            // Tópicos para "Desenvolvimento Web com PHP e Laravel"
            ['course_id' => 2, 'name' => 'Fundamentos de PHP', 'description' => 'Introdução à linguagem de programação PHP.'],
            ['course_id' => 2, 'name' => 'Arquitetura MVC com Laravel', 'description' => 'Padrões de design e estrutura MVC no Laravel.'],
            ['course_id' => 2, 'name' => 'Banco de Dados com Eloquent', 'description' => 'Uso do Eloquent ORM para interação com bancos de dados.'],
            ['course_id' => 2, 'name' => 'Autenticação e Autorização', 'description' => 'Implementação de sistemas de login e controle de acesso.'],
            ['course_id' => 2, 'name' => 'Desenvolvimento de APIs RESTful', 'description' => 'Criação e consumo de APIs RESTful com Laravel.'],

            // Tópicos para "Gestão de Projetos Ágeis"
            ['course_id' => 3, 'name' => 'Introdução à Gestão Ágil', 'description' => 'Conceitos básicos e princípios da gestão ágil.'],
            ['course_id' => 3, 'name' => 'Scrum e Kanban', 'description' => 'Frameworks ágeis mais utilizados.'],
            ['course_id' => 3, 'name' => 'Planejamento e Estimativas', 'description' => 'Técnicas de planejamento e estimativas em projetos ágeis.'],
            ['course_id' => 3, 'name' => 'Gerenciamento de Riscos', 'description' => 'Identificação e mitigação de riscos em projetos ágeis.'],

            // Tópicos para "Treinamento em Atendimento ao Cliente"
            ['course_id' => 4, 'name' => 'Comunicação Eficaz', 'description' => 'Técnicas de comunicação clara e eficaz com os clientes.'],
            ['course_id' => 4, 'name' => 'Resolução de Conflitos', 'description' => 'Estratégias para resolver conflitos e reclamações de clientes.'],
            ['course_id' => 4, 'name' => 'Empatia no Atendimento', 'description' => 'A importância da empatia no atendimento ao cliente.'],
            ['course_id' => 4, 'name' => 'Fidelização de Clientes', 'description' => 'Técnicas para criar clientes leais e satisfeitos.'],

            // Tópicos para "SEO para E-commerce"
            ['course_id' => 5, 'name' => 'Introdução ao SEO', 'description' => 'Conceitos e práticas de SEO.'],
            ['course_id' => 5, 'name' => 'Pesquisa de Palavras-chave', 'description' => 'Identificação de palavras-chave relevantes para e-commerce.'],
            ['course_id' => 5, 'name' => 'Otimização On-Page', 'description' => 'Melhorias em conteúdo e estrutura de páginas para SEO.'],
            ['course_id' => 5, 'name' => 'Link Building', 'description' => 'Estratégias para aquisição de backlinks.'],

            // Tópicos para "Design de Interfaces de Usuário"
            ['course_id' => 6, 'name' => 'Princípios de Design UI', 'description' => 'Fundamentos do design de interfaces de usuário.'],
            ['course_id' => 6, 'name' => 'Wireframing e Prototipagem', 'description' => 'Criação de wireframes e protótipos de interface.'],
            ['course_id' => 6, 'name' => 'Usabilidade e Acessibilidade', 'description' => 'Práticas para melhorar a usabilidade e acessibilidade.'],
            ['course_id' => 6, 'name' => 'Ferramentas de Design UI', 'description' => 'Uso de ferramentas como Sketch e Adobe XD.'],

            // Tópicos para "Técnicas de Vendas e Negociação"
            ['course_id' => 7, 'name' => 'Psicologia das Vendas', 'description' => 'Entendimento do comportamento do consumidor.'],
            ['course_id' => 7, 'name' => 'Técnicas de Fechamento', 'description' => 'Métodos para fechar vendas de forma eficaz.'],
            ['course_id' => 7, 'name' => 'Negociação e Persuasão', 'description' => 'Estratégias para negociar e persuadir.'],
            ['course_id' => 7, 'name' => 'Gerenciamento de Objeções', 'description' => 'Como lidar com objeções dos clientes.'],

            // Tópicos para "Desenvolvimento de Aplicativos Mobile"
            ['course_id' => 8, 'name' => 'Fundamentos de Desenvolvimento Mobile', 'description' => 'Conceitos básicos para desenvolvimento de apps.'],
            ['course_id' => 8, 'name' => 'Desenvolvimento para iOS', 'description' => 'Criando aplicativos para o sistema iOS.'],
            ['course_id' => 8, 'name' => 'Desenvolvimento para Android', 'description' => 'Criando aplicativos para o sistema Android.'],
            ['course_id' => 8, 'name' => 'Design Responsivo', 'description' => 'Princípios de design responsivo para dispositivos móveis.'],

            // Tópicos para "Introdução ao Google Ads"
            ['course_id' => 9, 'name' => 'Fundamentos do Google Ads', 'description' => 'Introdução e conceitos básicos do Google Ads.'],
            ['course_id' => 9, 'name' => 'Configuração de Campanhas', 'description' => 'Como configurar e gerenciar campanhas no Google Ads.'],
            ['course_id' => 9, 'name' => 'Estratégias de Lances', 'description' => 'Diferentes estratégias de lances para otimizar resultados.'],
            ['course_id' => 9, 'name' => 'Medição e Otimização', 'description' => 'Medição de desempenho e otimização de campanhas.'],

            // Tópicos para "Treinamento em Excel Avançado"
            ['course_id' => 10, 'name' => 'Funções e Fórmulas Avançadas', 'description' => 'Uso de funções complexas e fórmulas em Excel.'],
            ['course_id' => 10, 'name' => 'Tabelas Dinâmicas', 'description' => 'Criação e uso de tabelas dinâmicas para análise de dados.'],
            ['course_id' => 10, 'name' => 'Macros e VBA', 'description' => 'Automatização de tarefas com macros e VBA.'],
            ['course_id' => 10, 'name' => 'Análise de Dados', 'description' => 'Ferramentas e técnicas para análise de dados no Excel.'],

            // Tópicos para "Gerenciamento de Redes Sociais"
            ['course_id' => 11, 'name' => 'Estratégia de Conteúdo', 'description' => 'Planejamento e criação de conteúdo para redes sociais.'],
            ['course_id' => 11, 'name' => 'Publicidade em Redes Sociais', 'description' => 'Criação e gestão de anúncios em plataformas sociais.'],
            ['course_id' => 11, 'name' => 'Engajamento e Comunidade', 'description' => 'Construção e manutenção de uma comunidade online.'],
            ['course_id' => 11, 'name' => 'Análise de Métricas', 'description' => 'Medição e análise de desempenho em redes sociais.'],

            // Tópicos para "Programação em JavaScript"
            ['course_id' => 12, 'name' => 'Fundamentos de JavaScript', 'description' => 'Conceitos básicos e sintaxe da linguagem JavaScript.'],
            ['course_id' => 12, 'name' => 'Manipulação do DOM', 'description' => 'Interação com o Document Object Model (DOM).'],
            ['course_id' => 12, 'name' => 'Programação Assíncrona', 'description' => 'Trabalho com Promises e async/await.'],
            ['course_id' => 12, 'name' => 'Bibliotecas e Frameworks', 'description' => 'Uso de bibliotecas e frameworks como React e Vue.js.'],

            // Tópicos para "Inteligência Emocional no Trabalho"
            ['course_id' => 13, 'name' => 'Autoconhecimento', 'description' => 'Entendendo suas próprias emoções e reações.'],
            ['course_id' => 13, 'name' => 'Gerenciamento de Emoções', 'description' => 'Técnicas para gerenciar emoções no ambiente de trabalho.'],
            ['course_id' => 13, 'name' => 'Empatia e Relacionamentos', 'description' => 'Desenvolvimento de empatia e relacionamentos saudáveis.'],
            ['course_id' => 13, 'name' => 'Tomada de Decisão', 'description' => 'Uso da inteligência emocional na tomada de decisões.'],

            // Tópicos para "E-mail Marketing Eficaz"
            ['course_id' => 14, 'name' => 'Criação de Campanhas', 'description' => 'Planejamento e execução de campanhas de e-mail.'],
            ['course_id' => 14, 'name' => 'Segmentação de Lista', 'description' => 'Como segmentar e personalizar e-mails para diferentes públicos.'],
            ['course_id' => 14, 'name' => 'Análise de Resultados', 'description' => 'Medição e análise de resultados de campanhas.'],
            ['course_id' => 14, 'name' => 'Automação de E-mail', 'description' => 'Uso de automação para campanhas de e-mail marketing.'],

            // Tópicos para "Treinamento em Gestão de Tempo"
            ['course_id' => 15, 'name' => 'Priorização de Tarefas', 'description' => 'Como priorizar tarefas de maneira eficaz.'],
            ['course_id' => 15, 'name' => 'Técnicas de Planejamento', 'description' => 'Ferramentas e técnicas para planejar seu tempo.'],
            ['course_id' => 15, 'name' => 'Evitar Procrastinação', 'description' => 'Métodos para evitar a procrastinação.'],
            ['course_id' => 15, 'name' => 'Equilíbrio Trabalho-Vida', 'description' => 'Como manter um equilíbrio saudável entre trabalho e vida pessoal.'],

            // Tópicos para "Análise de Dados para Negócios"
            ['course_id' => 16, 'name' => 'Fundamentos de Análise de Dados', 'description' => 'Conceitos básicos de análise de dados para negócios.'],
            ['course_id' => 16, 'name' => 'Ferramentas de Análise de Dados', 'description' => 'Introdução às principais ferramentas de análise.'],
            ['course_id' => 16, 'name' => 'Visualização de Dados', 'description' => 'Como criar visualizações eficazes de dados.'],
            ['course_id' => 16, 'name' => 'Tomada de Decisão Baseada em Dados', 'description' => 'Utilização de dados para suportar decisões empresariais.'],

            // Tópicos para "UX Writing: Escrita para Interfaces"
            ['course_id' => 17, 'name' => 'Princípios de UX Writing', 'description' => 'Fundamentos da escrita para experiência do usuário.'],
            ['course_id' => 17, 'name' => 'Técnicas de Microcopy', 'description' => 'Criação de textos curtos e informativos para interfaces.'],
            ['course_id' => 17, 'name' => 'Acessibilidade em UX Writing', 'description' => 'Como tornar o conteúdo acessível a todos os usuários.'],
            ['course_id' => 17, 'name' => 'Testes de Usabilidade', 'description' => 'Métodos para testar e melhorar a escrita para UX.'],

            // Tópicos para "Marketing de Conteúdo"
            ['course_id' => 18, 'name' => 'Planejamento de Conteúdo', 'description' => 'Desenvolvimento de um plano de marketing de conteúdo.'],
            ['course_id' => 18, 'name' => 'Criação de Conteúdo', 'description' => 'Técnicas para criar conteúdo relevante e atraente.'],
            ['course_id' => 18, 'name' => 'Distribuição de Conteúdo', 'description' => 'Estratégias para distribuir conteúdo de forma eficaz.'],
            ['course_id' => 18, 'name' => 'Análise de Desempenho', 'description' => 'Medição e análise de resultados de conteúdo.'],

            // Tópicos para "Noções Básicas de Programação Python"
            ['course_id' => 19, 'name' => 'Sintaxe e Estruturas Básicas', 'description' => 'Introdução à sintaxe e estruturas de dados em Python.'],
            ['course_id' => 19, 'name' => 'Manipulação de Dados', 'description' => 'Trabalhando com listas, dicionários e outros tipos de dados.'],
            ['course_id' => 19, 'name' => 'Programação Orientada a Objetos', 'description' => 'Conceitos de POO aplicados em Python.'],
            ['course_id' => 19, 'name' => 'Bibliotecas e Módulos', 'description' => 'Introdução ao uso de bibliotecas e módulos em Python.'],

            // Tópicos para "Segurança da Informação para Empresas"
            ['course_id' => 20, 'name' => 'Princípios de Segurança da Informação', 'description' => 'Fundamentos da segurança da informação no ambiente empresarial.'],
            ['course_id' => 20, 'name' => 'Políticas de Segurança', 'description' => 'Desenvolvimento de políticas de segurança para empresas.'],
            ['course_id' => 20, 'name' => 'Gerenciamento de Incidentes', 'description' => 'Como lidar com incidentes de segurança.'],
            ['course_id' => 20, 'name' => 'Criptografia e Proteção de Dados', 'description' => 'Uso de criptografia para proteger informações sensíveis.'],

            // Tópicos para "Técnicas de Apresentação e Oratória"
            ['course_id' => 21, 'name' => 'Preparação de Apresentações', 'description' => 'Como preparar e organizar uma apresentação eficaz.'],
            ['course_id' => 21, 'name' => 'Técnicas de Comunicação Verbal', 'description' => 'Desenvolvimento de habilidades de comunicação verbal.'],
            ['course_id' => 21, 'name' => 'Uso de Recursos Visuais', 'description' => 'Como usar recursos visuais para melhorar sua apresentação.'],
            ['course_id' => 21, 'name' => 'Controle do Nervosismo', 'description' => 'Técnicas para lidar com o nervosismo durante apresentações.'],

            // Tópicos para "Planejamento Estratégico"
            ['course_id' => 22, 'name' => 'Análise SWOT', 'description' => 'Análise de forças, fraquezas, oportunidades e ameaças.'],
            ['course_id' => 22, 'name' => 'Definição de Objetivos', 'description' => 'Como definir objetivos estratégicos para a empresa.'],
            ['course_id' => 22, 'name' => 'Implementação de Estratégias', 'description' => 'Técnicas para implementar estratégias organizacionais.'],
            ['course_id' => 22, 'name' => 'Monitoramento e Avaliação', 'description' => 'Como monitorar e avaliar o progresso das estratégias.'],

            // Tópicos para "Desenvolvimento de Liderança"
            ['course_id' => 23, 'name' => 'Estilos de Liderança', 'description' => 'Diferentes estilos de liderança e suas aplicações.'],
            ['course_id' => 23, 'name' => 'Motivação de Equipes', 'description' => 'Estratégias para motivar e inspirar equipes.'],
            ['course_id' => 23, 'name' => 'Tomada de Decisões', 'description' => 'Técnicas de tomada de decisão eficaz.'],
            ['course_id' => 23, 'name' => 'Gestão de Conflitos', 'description' => 'Como gerenciar e resolver conflitos dentro da equipe.'],

            // Tópicos para "Branding: Construção de Marca"
            ['course_id' => 24, 'name' => 'Identidade Visual', 'description' => 'Desenvolvimento de uma identidade visual consistente.'],
            ['course_id' => 24, 'name' => 'Posicionamento de Marca', 'description' => 'Estratégias para posicionar a marca no mercado.'],
            ['course_id' => 24, 'name' => 'Construção de Narrativa', 'description' => 'Criação de uma narrativa de marca envolvente.'],
            ['course_id' => 24, 'name' => 'Engajamento com o Cliente', 'description' => 'Como engajar clientes e construir uma comunidade em torno da marca.'],

            // Tópicos para "Análise de Métricas em Marketing Digital"
            ['course_id' => 25, 'name' => 'KPIs e Métricas', 'description' => 'Identificação de KPIs e métricas relevantes.'],
            ['course_id' => 25, 'name' => 'Google Analytics', 'description' => 'Uso do Google Analytics para análise de dados.'],
            ['course_id' => 25, 'name' => 'Atribuição e ROI', 'description' => 'Cálculo de retorno sobre investimento e atribuição.'],
            ['course_id' => 25, 'name' => 'Análise de Dados e Relatórios', 'description' => 'Como criar e interpretar relatórios de dados.'],
        ]);
    }
}
