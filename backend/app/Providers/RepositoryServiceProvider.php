<?php

namespace App\Providers;

use App\Interfaces\CourseRepositoryInterface;
use App\Interfaces\EnrollmentRepositoryInterface;
use App\Interfaces\LessonRepositoryInterface;
use App\Interfaces\TopicRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Repositories\CourseRepository;
use App\Repositories\EnrollmentRepository;
use App\Repositories\LessonRepository;
use App\Repositories\TopicRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

/**
 * O RepositoryServiceProvider é responsável por registrar implementações de repositórios no container de serviço do Laravel.
 * Isso permite que o sistema utilize o padrão de repositório, facilitando a injeção de dependências e a substituição de implementações.
 * Por exemplo, ele vincula a interface `CourseRepositoryInterface` à implementação concreta `CourseRepository`.
 *
 * Esse padrão é útil em situações onde você pode querer alterar a forma como os dados são armazenados ou acessados
 * sem alterar a lógica de negócios da aplicação. Por exemplo, você pode inicialmente usar um repositório que
 * interage com um banco de dados MySQL, mas depois decidir mudar para um repositório que obtém dados de uma
 * API externa. A utilização de uma interface e um repositório facilita essa transição, já que o restante
 * da aplicação continua a depender da interface, independentemente da implementação concreta.
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Vincula a interface CourseRepositoryInterface à implementação CourseRepository.
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(CourseRepositoryInterface::class, CourseRepository::class);
        $this->app->bind(TopicRepositoryInterface::class, TopicRepository::class);
        $this->app->bind(LessonRepositoryInterface::class, LessonRepository::class);
        $this->app->bind(EnrollmentRepositoryInterface::class, EnrollmentRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
