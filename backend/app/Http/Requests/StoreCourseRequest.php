<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * A classe StoreCourseRequest é uma implementação de FormRequest do Laravel, utilizada para validar e autorizar
 * requisições HTTP de forma centralizada e consistente. Esta classe é usada para tratar a validação dos dados
 * enviados na criação de um novo curso, assegurando que os dados recebidos sejam válidos antes de serem processados
 * pelo controlador.

 * **Funcionamento:**
 * 1. **Autorização (`authorize`):** O método `authorize` determina se o usuário está autorizado a fazer a requisição.
 *    Neste exemplo, está retornando `true` para permitir que todos os usuários passem pela validação.
 *    Normalmente, você pode usar `auth()->check()` para permitir apenas usuários autenticados.

 * 2. **Regras de Validação (`rules`):** O método `rules` retorna um array de regras de validação para os campos da
 *    requisição. No caso de um curso, as regras são:
 *    - `name`: Obrigatório, string e com um máximo de 100 caracteres.
 *    - `description`: Opcional (nullable), string e com um máximo de 255 caracteres.
 *    - `status`: Obrigatório e deve ser um dos valores 'open' ou 'restricted'.

 * 3. **Tratamento de Erros de Validação (`failedValidation`):** Este método é chamado quando a validação falha.
 *    Ele lança uma `HttpResponseException` com uma resposta JSON detalhando os erros de validação. Isso permite que
 *    a resposta HTTP seja padronizada e amigável, informando ao usuário quais campos contêm erros.

 * **Exemplo de Uso:**
 * Quando um usuário tenta criar um novo curso através de uma API, esta classe verifica se os dados enviados
 * atendem aos critérios especificados. Por exemplo, se o nome do curso for omitido ou exceder 100 caracteres,
 * ou se o status não for 'open' ou 'restricted', a requisição falhará e retornará uma resposta JSON indicando
 * o(s) erro(s). Isso ajuda a manter a integridade dos dados e fornece feedback claro ao usuário.
 */

class StoreCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        #return auth()->check();
        //para testes
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
            'status' => 'required|in:open,restricted',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            [
                'success' => false,
                'message' => 'Validation errors',
                'data' => $validator->errors()
            ]
        ));

    }
}
