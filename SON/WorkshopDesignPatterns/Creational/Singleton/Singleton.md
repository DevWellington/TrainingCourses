#Singleton

###Objetivo

	- Assegurar que uma classe tenha somente uma instancia e forneca um ponto global de acesso a ela

	- Permitir o refinamento de operacoes e representacao
	- Ex: Somente 1 conexao com o BD.

###Aplicabilidade

	- Quando uma unica instancia eh necessária e deve estar acessivel aos clientes a partir de um ponto de acesso conhecido (Conexao com BD, logs, etc)

###Observacoes
	
	- Em muitos projetos web veremos que em muitas vezes o Singleton parece não ter sentido;

Utiliza metodos estaticos `static::getInstance();`

###Requisitos

	- Metodos Estaticos;
	- Metodo getInstance();
	- Retornar somente uma única instancia
	- Construtor privado

###Vantagens 
	
	- Acesso central a recursos e objetos

###CUIDADO

	- Dificil de testar
	- Uso como substituto de variaveis globais
