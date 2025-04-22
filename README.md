# Desafio Kabum - Sistema de Gerenciamento

Bem-vindo ao projeto Desafio Kabum! Este é um sistema de gerenciamento desenvolvido como parte do processo seletivo.

## Pré-requisitos

- XAMPP instalado (Apache e MySQL)
- Git instalado
- PHP 7.0 ou superior
- MySQL 5.7 ou superior

## Instalação

### 1. Clonando o projeto para o htdocs do XAMPP

Abra o terminal ou prompt de comando e execute:

```bash
cd C:\xampp\htdocs  # No Windows
# OU
cd /opt/lampp/htdocs  # No Linux

git clone git@github.com:HENR1QUEF0NSECA/Desafio-Kabum.git
```

### 2. Configurando o banco de dados

O projeto inclui um arquivo DLL com a estrutura do banco de dados:

1. Localize o arquivo `desafioKabumDLL.zip` na pasta do projeto  
2. Descompacte o arquivo para obter `desafioKabumDLL.dll`  
3. Importe para o MySQL via phpMyAdmin:
   - Acesse [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
   - Crie um novo banco de dados chamado `desafio_kabum`
   - Vá para a aba **"Importar"**
   - Selecione o arquivo `desafioKabumDLL.dll`
   - Clique em **"Executar"**

---

### 3. Configurando a aplicação

Edite o arquivo de configuração `config.php` (se existir) com as credenciais do seu banco de dados:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'desafio_kabum');
```
### 4. Executando a aplicação
Inicie o XAMPP (Apache e MySQL)

Acesse no navegador:

http://localhost/Desafio-Kabum

### 5. Suporte
Para problemas ou dúvidas, entre em contato ou abra uma issue no repositório.

### 6. Licença
Este projeto é para fins de avaliação técnica e não possui licença aberta.
