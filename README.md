
# TaskManagementSystem

Projeto PHP no Framework Zend com o proposito de teste técnico para posição de PHP na Meisters Solutions

## Introdução

Esta aplicação é uma modificação da aplicação esqueleto fornecida pelo Zend Framework.
O objetivo desta aplicação é servir de teste técnico para posição de PHP na Meisters Solutions

## Stack utilizada

**Front-end:** 

**Back-end:** PHP 7.3.21, Composer, WAMP


## Instalação utilizando Composer

Devido incompatibilidade com a versão atual do Composer (2.6.4), foi necessário utlizar uma versão mais antiga do Composer [1.10.24]
(https://getcomposer.org/download/1.10.24/composer.phar)


Ainda devido a problemas de incompatibilidade com a versão atual do Composer (2.6.4), foi necessário utilizar o seguitne método de instalação:


cd wamp64/www/TaskManagementSystem_FabianoFaria

git clone git://github.com/zendframework/ZendSkeletonApplication.git

cd ZendSkeletonApplication

php composer.phar self-update

php composer.phar install

## Deploy

Para fazer o deploy desse projeto rode

```bash
  php -S 0.0.0.0:8080 -t public public/index.php
```

## Unit Test

Para rodar os testes unitarios

```bash
  ./vendor/bin/phpunit
```

Para rodar testes unitarios espacificos

```bash
  ./vendor/bin/phpunit --testsuite { Modulo desejado }
```

## Mysql

Estrutura da tabela `tarefas` 

```bash
CREATE TABLE `tarefas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `creation_date` datetime NOT NULL,
  `status` smallint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1
```


## Autor

- [@FabianoFaria](https://github.com/FabianoFaria)


## Referência

- [Zend Framework 2 documentation](https://zf2-documentation-br.readthedocs.io/pt/latest/ref/overview.html)
- [Composer documentation](https://getcomposer.org/doc/)
- [docs.zendframework.com](https://docs.zendframework.com/tutorials/getting-started/overview/)
- ["Module (User) could not be initialized" : Exception in Zend Framework 2](https://stackoverflow.com/questions/43343437/module-user-could-not-be-initialized-exception-in-zend-framework-2)
- [php fatal error Declaration of UserTest setUp function](https://stackoverflow.com/questions/58393289/php-fatal-error-declaration-of-usertest-setup-function)