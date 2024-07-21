# API ViaCEP

Este projeto é uma API simples construída com Laravel para consultar informações de endereços a partir de códigos postais (CEPs) usando a API ViaCEP.

## Requisitos

- PHP 8.0 ou superior
- Composer
- [Laravel 11](https://laravel.com/)
- [cURL](https://curl.se/)

## Instalação

Siga estes passos para configurar e executar o projeto:

1. **Clone o repositório**
   git clone https://github.com/felipe29j/api-via-cep.git  ou
   git clone git@github.com:felipe29j/api-via-cep.git

2. **Acesse o diretório do projeto**
    cd api-via-cep

3. **Instale as dependências do projeto**
    composer install

4. **Configure o ambiente**
  Renomeie o arquivo .env.example para .env e ajuste as configurações conforme necessário. O arquivo .env deve ser configurado da seguinte forma:
    DB_CONNECTION=sqlite
    SESSION_DRIVER=array
    
   Se já não estiver configurado no .env

5. **Inicie o servidor de desenvolvimento**
    php artisan serve

6. **Teste a API**
    Acesse a URL da API para consultar CEPs:
        http://localhost:8000/search/local/{ceps}

    Substitua {ceps} por uma lista de CEPs separados por vírgula, por exemplo:
        http://localhost:8000/search/local/01001000,17560-246

      
**Estrutura do Projeto**  
    app/Http/Controllers/SearchController.php: Controlador responsável por buscar dados de endereços usando a API ViaCEP.
    routes/web.php: Define a rota para a consulta de CEPs.
    .env: Configurações do ambiente, como driver de sessão.

**Problemas Conhecidos**  
    Problemas com SSL: Se você encontrar erros relacionados a certificados SSL, considere atualizar o CA Bundle do cURL ou desativar temporariamente a verificação SSL (não recomendado para produção).

**Contribuições**  
    Sinta-se à vontade para contribuir com melhorias ou correções. Para enviar uma contribuição, siga estas etapas:

        1.Faça um fork do repositório.
        2.Crie uma branch para sua alteração.
        3.Envie um pull request descrevendo suas mudanças.