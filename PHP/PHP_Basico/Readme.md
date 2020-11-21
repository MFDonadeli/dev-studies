Conceitos de PHP Básico

```
php -S localhost:8000 -> inicia um servidor web para testar os phps
```

##Cookies
São arquivos que guardam algumas informações do usuário e retornam sempre que o usuário navegar novamente no sistema

##Sessões
Também exibem e guardam informações do usuário, mas contém dados sensíveis que tem que ser protegido

As sessões também pode ser salvas em outros meios, isso pode ser configurado no PHP.ini em session.save_handler
session.save_path tem o caminho que vai ser usado para ser salvo.

As configurações do PHP.ini também pode ser mudada com o comando ini_set

##Forms

csrf = cross-site request forgery: Um token como uma senha. É usado sempre com uma sessão. Compara o token da sessão com o enviado pelo formulário.