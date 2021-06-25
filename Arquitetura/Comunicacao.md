Nem sempre é melhor usar o REST por conta da espero da resposta.

Cada microserviço, em geral, tem seu banco de dados.

## Comunicação sincrona e assíncrona

Consistencia eventual: Dois dados estão inconsistentes agora, mas daqui a pouco estarão sincronizados de novo, por exemplo, em um microserviço que tem a informação completa dos produtos e outro microserviço que sincroniza apena parte desses dados para trabalhar mais rapdimanete com dados locais. As vezes uma alteração nesse microserviço menor pode ser feita e ainda não ser alterada no microserviço maior.

Comunicação síncrona: Em tempo real. Baseado em consistência.

Comunicação assíncrona: Não preciso ter a resposta em tempo real. Pode ter eventualmente dados inconsistentes.

## REST

REpresentational State of Transfer

É simples, cacheável e stateless (sem guardar estado, passar o token para saber que está autenticado por exemplo)

- Maturidade 1: Utilização de resources (GET para buscar, POST para inserir, PUT para alterar e DELETE para remover)
- Maturidade 2: Verbos HTTP, utilizar o verbo certo para a operação correta (GET para buscar, POST para inserir, PUT para alterar e DELE para remover)
- Maturidade 3: HATEOAS: Hypermedia As The Engine Of Application State (responde o endpoint com as instruções do que mais vocÊ poderá fazer com aquilo, por exemplo um GET de saldo que retorna alguns outros links para depósito, transferência, etc)

### Boa api rest

- URIs unicas para serviços e itens 
- Utlizar todos os verbos HTTP para as operações, incluindo caching
- Provê links relacionais para recursos exemplificando o que pode ser feito

O Json é difícil de padronizar, então, existem alguns recursos para facilitar:
- JSON HAL: Hypermedia Application Language (Media type: application/hal+json), explicita mais as coisas, por exemplo, passando uma pessoa, pode passar também junto o link para acessar o perfil para aquela pessoa.
- Method negotiation: Verbo OPTIONS que diz quais métodos são ou não permitidos em determinados recursos, acessando um endpoint.
- Content negotiation: Diz qual tipo de conteudo aquele endpoint aceita.
    - Aqui pode por exemplo omitir a versão da API na chamada e o Content-Type whitelist vai redirecionar para a versão certa.

## gPRC

RPC: Remote Procedure Call, quando eu quero que um cliente execute uma função no servidor. Desenvolvido pelo Google e facilita o processo de comunicação entre sistemas. 

Onde utilizar:
- Microserviços
- mobile, browsers e backend
- gera biblioteca automaticamente (stubs) contratos certinhos
- streaming bidirecional usando HTTP/2

Linguagens: GoLang, Java, C e C++, Python, Ruby, PHP, Kotlin, etc.

Usa protocols buffers: Linguagem neutra do Google, como um XML porém mais simples. Usa arquivos binários, mais leve, processo rapido

HTTP/2: Criado pelo Google, trafego binario, TCP uma conexão envia e recebe, header comprimido

API unary: comunicação normal, response e request
API streaming: recebe as respostas nem sempre 100% prontas. Vai recebendo pedaços.
No gRPC o streaming vai para ida (request) e volta (response).


