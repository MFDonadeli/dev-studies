Docker

Docker é um sistema de containers

Container:
- Uma unidade de software que empacota código e todas as dependências de uma aplicação para que rode de forma segura se mudar de máquina por exemplo.
- O docker utiliza os recursos do computador para funcionar, o que já tem instalado ele não reinstala, instala só o que precisa.
- O container pensa que é uma máquina completa, mas ele só se aproveita dos recursos já instalados, é só um processo a mais.
- São baseados em imagem, são instruções do que tem que fazer dentro da máquina.
- São processos (e namespaces) que isolam o que está rodando ali dentro, ou seja, enganamos o sistema operacional pensando que é só um processo porém é quase todo uma máquina (grupos de processos) que está rodando ali dentro, ele isola os processos (Cgroups que vão controlar os recursos usados pelo seu computador)

Comandos básicos

docker run <opcoes> <imagem>: Roda (e baixa se náo estiver instalada) uma imagem do Docker
    -it -i modo interativo (o stdin ficará ativo), -t tty para digitar coisas no terminal 
    -rm roda e remove o container no fim da execução
    -p <porta_do_meu_computador>:<porta_docker> redireciona portas para acessar portas do container
    -d detach, ou seja, roda e libera o meu terminal do processo do Docker
    rm <id ou nome> remove o container, com -f força a remoção. Para remover tudo use docker rm $(docker ps -a -q) -f
    --name dá um nome para o meu container
    -v <pasta_meu_computador>:<pasta_docker> monta a pasta do meu computador dentro do container
    --mount type=<tipo>,source=<pasta_meu_computador>,target=<pasta_docker> monta a pasta do meu computador dentro do meu container
        tipo: bind se eu quero montar uma pasta
        volume: se eu quero montar um volume já criado
docker ps: mostra os dockers que estão rodando no momento, 
    -a mostra os dockers suspensos, com -q mostra só os ids
docker start: reinicia um docker suspenso
docker exec roda um comando dentro do docker que está rodando 
        docker exec nginx ls roda o comando somente
        docker exec -it nginx bash roda o comando com entrada e tty ativos
docker volume create <volume>: cria um volume dentro de uma pasta no meu computador
docker build <caminho> roda o docker file

Dockerfile

FROM <baseimage>

WORKDIR <pasta_container>: pasta onde os comandos serão executados dentro do container

RUN <comandos>
RUN <comando> && \
    <comando>

COPY <pasta_meu_computador> <caminho_container>

ENTRYPOINT [<comando>, <continuacao_comando>] comando fixo

CMD [<comando>,<continuacao_comando>], essa linha vai ser substituida sempre por um comando se passada na hora da execução (comando variável):
    docker run --rm <container> echo "oi", ele mostra oi ao invés de CMD['echo', 'Hello World']

