## Avaliação de performance no MySQL

[Link do Treinamento](http://code-squad.com/screencast/avaliacao-performance-mysql/avulso) | 
[Meu Certificado de Partifipação](http://code-squad.com/certificado/avaliacao-performance-mysql/DevWellington)

**my.cnf**

Fazer log das queries lentas
- variaveis: log_slow_queries and long_query_time

Utilizar uma ferramenta para análisar as *long* queries;
- Full table scan, indices, etc;

Emular uma carga e ver estatisticas
- [Link](http://www.techrepublic.com/blog/how-do-i/how-do-i-stress-test-mysql-with-mysqlslap/) com todos os passos para execução dos Testes.
Exemplo de Estatistica:

```
shell> /usr/local/mysql/bin/mysqlslap --user=john --auto-generate-sql --concurrency=100

Benchmark
Average number of seconds to run all queries: 0.698 seconds
Minimum number of seconds to run all queries: 0.698 seconds
Maximum number of seconds to run all queries: 0.698 seconds
Number of clients running queries: 100
Average number of queries per client: 0
```

Exemplo com mysqladmin 


Conexões em Execução:

```shell
mysqladmin -uroot -psenha extended -i5  | grep Threads_running
| Threads_running                               | 2            |
| Threads_running                               | 10           |
| Threads_running                               | 1            |
```

Quantidade de Queries ja executadas:
```shell
mysqladmin -uroot -psenha extended -i5  | grep Questions
```

**InnoTop**

```shell
innotop --host=[host] --user=[user] --password=[password]

## HELP OPTIONS ##

Switch to a different mode:
   B  InnoDB Buffers    I  InnoDB I/O Info     Q  Query List
   C  Command Summary   L  Locks               R  InnoDB Row Ops
   D  InnoDB Deadlocks  M  Replication Status  S  Variables & Status
   F  InnoDB FK Err     O  Open Tables         T  InnoDB Txns

Actions:
   d  Change refresh interval        q  Quit innotop
   n  Switch to the next connection  r  Reverse sort order
   p  Pause innotop                  s  Choose sort column

Other:
 TAB  Switch to the next server group   /  Quickly filter what you see
   !  Show license and warranty         =  Toggle aggregation
   #  Select/create server groups       @  Select/create server connections
   $  Edit configuration settings       \  Clear quick-filters
```

**tunning-primer.sh**

- Script que avalia o status do servidor e sugere mudancas na configuração;
- [Link de acesso](https://launchpad.net/mysql-tuning-primer)

Obs.: É necessário executar no Server Local









