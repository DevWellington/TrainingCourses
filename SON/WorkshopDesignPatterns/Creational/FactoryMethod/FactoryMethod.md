#Factory Method

###Objetivo

	- Definir uma interface para criar um objeto, mas deixar que a subclasse decida qual classe deve ser instanciada

###Vantagens

	- Remove a necessidade de vincular classes especificas de aplicacao ao codigo. O codigo interage unicamente com uma interface, assim funcionara com quaisquer classes que implementam tal interface.

###Quando usar?

	- Quando a classe nao eh capaz de antecipar a classe de objetos que ela precisa criar.

	- Quando uma classe quer que subclasses especifiquem os objetos que ele instancia.

![UML Factory Method](http://upload.wikimedia.org/wikipedia/commons/9/97/Factory_Method_%28portuguese%29.png)

###Lembrando 

	- Para criar objeto (tenho que saber o nome da tabela) nao eh mais necessario saber a classe concreta do objeto a ser criaro, **mas ainda eh preciso saber a classe do criador.**

###Concluindo 
	
	- Criacao de objetos eh desacoplada do conhecimento do tipo concreto do objeto.

	- Conecta hierarquias de classe paralelas e facilita a extensibilidade.

###Desvantagens

	- E preciso saber a classe concreta do criador de instancias.
