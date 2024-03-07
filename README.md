## Aplicação back-end Teste Prático Adoorei

## Instruções para rodar a aplicação

- Copie o .env.example para .env (Configurar .env corretamente com o ambiente atual, realizar o mesmo procedimento para o .env contido em ./application)
- Execute o comando: **docker-compose up -d --build** para subir os contêiner
- Assim que os contêiner estiver 'up' acesse o contêiner da aplicação, no nosso caso se chama 'laravel' com o seguinte comando:  **docker exec -it laravel bash**
- Execute de dentro do contêiner os seguintes comandos:

  - composer install
  - php artisan config:cache (Rodar após a configuração do .env para limpar os cache)
  - php artisan config:clear

### Uso de Migrate e Seeder

- Foi criado migrate para as tabelas necessárias e seeder para popular a tabela de produtos (execute os comandos dentro do contêiner utilizado acima)
  - php artisan migrate
  - php artisan db:seed --class=ProductsTableSeeder  (popula a tabela produtos)

### Testes Unitários

- Para execução dos testes unitários, acesse o contêiner 'laravel' e execute o comando abaixo para executar os 2 arquivos de teste:
  - php vendor/bin/phpunit tests/Unit

### Sobre a aplicação

Aplicação back-end no formato API rest, utilizada para um loja fictícia que servirá para registrar a venda de celulares.

### Tecnologias utilizadas

- ### Laravel 10
- ### PHP 8.1

### Tecnologias para teste na Api

- ### Insominia

### Rotas da aplicação

### POST localhost:80/api/sales/process-sale

- Inserir nova venda
  exemplo request:

```json
{
	"idsProducts" : [1, 2]
}
```

### POST localhost:80/api/sales/add-product-to-sale

- Inserir produto à uma venda existente
  exemplo request:

```json
{
	"saleId" : 1,
	"idsProducts" : [3]
}
```

### PATCH localhost:80/api/sales/canceled-sale/{id}

- Cancelar uma venda

### GET localhost:80/api/sales/sale/{id}

- Consultar uma venda

### GET localhost:80/api/sales/list-all

- Listar todas as vendas com seus devidos produtos associados

### GET localhost:80/api/products/list-all

- Retorna todos os produtos disponiveis

Além desta Doc, irei disponibilizar um arquivo exportado do insomnia para facilitar o processo de testes contido na pasta (doc_insomnia), basta apenas restaurar no insomnia e utilizar os endpoints.
