#Abstract Factory

- O Factory Method eh um metodo que cria a classe, que retorna um objeto. (Nao confundir)

###Objetivo

**Famílias de Objetos**

	- Fornecer uma interface a ser utilizada na criacao de "familias de objetos" relacionados ou dependentes sem especificar suas Classes concretas
	

###Vantagens

	- Isolar o cliente das classes concretas "Não preciso saber a classe concreta";

	- Facilidade na troca de familias de objetos

	- Promove a consistencia entre objetos

###Quando usar?

	- O sistema precisa ser independente da maneira como seus objetos sao criados.

	- O sistema precisa ser configurado com um objeto de uma familia de varios objetos

![UML - Abstract Factory](https://raw.githubusercontent.com/DevWellington/TrainingCoursesOnVideo/master/SON/WorkshopDesignPatterns/Creational/AbstractFactory/abstract-factory.png)

A classe não precisa de saber o tipo do objeto concreto

```php
$gm = new GMFactory();

$carro1 = $gm->createCarroEconomico();
$carro2 = $gm->createCarroEsportivo();

$carro1->passear();
$carro2->correr();

```

- O Factory Method é **um** metodo de fabrica que fabrica dentro de uma classe.
	
	- É um metodo de fabrica que fabrica.

- No AbstractFactory, várias fabricas que implementam a mesma interface
	
	- Sempre vai retornar objetos do mesmo tipo, da mesma interface;

**Familia**

###Concluindo

	- A Criação de objetos eh totalmente desacoplada do conhecimento do tipo concreto do objeto.

	- Conecta hierarquias da classe paralelas e facilita a extensibilidade;
	
	- Ainda precisamos saber a classe concreta do criador de instancias;



