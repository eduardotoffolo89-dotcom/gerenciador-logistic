# Gerenciador Logístico

Projeto acadêmico desenvolvido para a disciplina **Fundamentos de Programação para Internet**.

## Objetivo
Gerenciar produtos, endereços, transportadores e fretes em uma aplicação web.

## Tecnologias
- PHP com PDO
- MySQL
- HTML5
- CSS3
- JavaScript
- Bootstrap 5

## Funcionalidades
- Cadastro, listagem, edição e exclusão de produtos.
- Cadastro, listagem, edição e exclusão de endereços.
- Cadastro, listagem, edição e exclusão de transportadores.
- Geração de frete com transportador, origem, destino e vários produtos.
- Relatório de fretes por data em CSV.

## Como executar no XAMPP (Windows)
1. Instale o XAMPP: https://www.apachefriends.org/pt_br/index.html
2. Abra o painel do XAMPP e inicie **Apache** e **MySQL**.
3. Extraia a pasta `gerenciador-logistico` para `C:\xampp\htdocs\`.
4. Abra `http://localhost/phpmyadmin`.
5. Na aba **Importar**, selecione o arquivo `database.sql` e execute.
6. Confira em `config/conexao.php` os dados de acesso. No XAMPP padrão, usuário `root` e senha vazia.
7. Acesse `http://localhost/gerenciador-logistico/`.

## Ordem sugerida para testar
1. Cadastre dois endereços (um de origem e outro de destino).
2. Cadastre um produto.
3. Cadastre um transportador.
4. Acesse **Fretes > Gerar frete** e selecione um ou mais produtos.
5. Acesse **Relatórios**, escolha a data e baixe o CSV.

## Publicar no GitHub
Crie um repositório público no GitHub e envie o conteúdo desta pasta. Inclua este README. Faça commits a cada alteração relevante.

## Observação
O projeto é uma base acadêmica funcional. Antes de usar em produção, seriam necessários autenticação, controle de permissões, proteção adicional contra CSRF, validações mais completas e testes.
