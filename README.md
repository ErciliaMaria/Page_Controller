# 📘 Projeto Livro PHP - CRUD com Autoload, PDO e MySQL

Este projeto é um exemplo prático de um sistema CRUD (Create, Read, Update, Delete) utilizando PHP puro, padrão MVC, conexão com banco de dados MySQL via PDO, e carregamento automático de classes com o Composer.

---

## 🚀 Funcionalidades

- ✅ Listagem de registros
- ✅ Cadastro de dados no banco MySQL
- ✅ Atualização de registros
- ✅ Remoção de dados
- ✅ Organização em camadas
- ✅ Autoload via Composer PSR-4

---

## 🧠 Habilidades Utilizadas

- **Composer Autoload**  
  Utilizado o padrão PSR-4 para carregamento automático das classes do projeto, evitando `require` manuais.

- **Divisão de Classes**  
  Estrutura baseada em camadas:
  - `Model` → Declaração de classes e mapeamento com o banco  
  - `Control` → Controladores que fazem a mediação com modelo 
  - `Database` → Repositórios, query builder, criteria, etc.

- **Conexão com MySQL via PDO**  
  A conexão com o banco de dados é feita com `PDO`, facilitando a portabilidade e segurança com uso de prepared statements.

---

## ⚙️ Instalação

1. Clone o repositório:
   ```bash
   https://github.com/ErciliaMaria/Page_Controller.git

2. Acesse o diretório:

    cd seu-projeto

3. Instale o Composer

    [Instale o Composer](https://getcomposer.org/download/)

    [Acesse aqui o guia de instalação do Composer (em português)](https://kinsta.com/pt/blog/instalar-composer/)


4. Use os comandos para iniciar o Composer

    - composer
    - composer ini
