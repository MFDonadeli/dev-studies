# Arquitetura

Organização de um sistema, contemplando seus componentes.

## Pilares

- Organização: Como ele é organizado para entregar um fim
- Componentização: Junção de componentes que dá o resultado final. Não só bibliotecas, mas componentes usados de forma integrada
- Relacionamento entre sistema: como vão se conversar
- Governança: Aceitação e compatibilidade dos sistemas onde vão ser instalados. Três pontos: Team, governança (como vão funcionar) e infra-estrutura
- Ambiente: Produção, testes e desenvolvimento. Como definir e padroniza-los.
- Projeto: Algo que tem inicio, meio e fim. 
- Projeção: Quais possibilidades de futuro. Hoje em dia são muitas possibilidades, sistemas comuns, microseerviços, etc
- Cultura: Como a equipe e as tecnologias vão afetar ali dentro da equipe e os profissionais dali dentro.

Framework: Delimita e ajuda a definir os padrões de trabalho.
- Togaf: Framework conceitual, define processos de arquitetura, conceitos e nomenclaturas, visão de arquiteturas de: negócio, sistemas de informação, tecnologia, planos de migração.
- ISO 42010: Mais simplificado que o TOGAF 

Hoje em dia:

Saímos do monolítico e estamos encaminhando para o Full Cycle, um desenvolvedor que consegue fazer todos os passos desde o desenvolvimento até o Deploy. Tipo de aplicações: Microserviços, Infra: containers.

No futuro: NoOps, sem se preocupar em tecnologias, só subir tudo na nuvem. Serveless. Paga-se on-demand a cada serviço que se utiliza.

## Tipos de sistemas

### Monolitico
- Monolítico: Tem tudo na sua própria estrutura. Tudo no mesmo sistema. Alto acoplamento. Deploy a cada mudança. Uma única tecnologia. Um problema afeta todo o sistema. Maior complexidade para o time. 
- Escala vertical: O sistema cresce dentro dele mesmo. O servidor de aplicação e assets são iguais, cache é centralizado, sessões também. 
- Escala horizontal: O sistema distribui em várias partes e máquinas. Nada é centralizado
- A minha App é só a minha App e só distribui, cada serviço é responsável por alguma coisa. Isso cria a possibilidade de fazer com que apps em várias áreas do mundo por exemplo.
- Escala horizontal no sistema monolítico: Tem imagens e containers, o servidor pode ser facilmente reconstruido, tem responsabilidades separadas.
- Quando eu posso trocar o sistema monolítico: Times grandes, necessidade de escalar todo o sistema por um ponto específico ser usado mais que outro, risco de deploy completo começa a se elevar, não consigo usar tecnologias diferentes.

### SOA
- Serviços: Indepente de tecnologia, resolve um problema de negócio.
- SOA: Arquitetura Orientada a Serviço. São conectados ao Enterprise Service Bus para se comunicarem entre si. Se cair o ESB, cai tudo. Compartilhar banco de dados é comum. Pode ser até sistemas monolíticos.

### Microserviços
- Microserviços: Não existe um centralizador, eles contém os próprios bancos de dados, e comunicam entre si (por mensagens)
- Não são para qualquer situação: Arquitetura complexa, custo mais elevado, monitoramento complexo.
- Características: 
    - Componentização via serviços: Uma unidade é totalmente independente, mas se conecta com as demais. Mas tem custo maior de comunicação principalmente. Pode ser complexo comunicar entre eles (pode ser n serviços se comunicando entre si)
    - Organização em torno do negócio: Pensando na finalidade que o produto completo tem que resolver. Geralmente o time por produto (ou microserviço). TImes divididos por squads (multidisciplinares).
    - Smart endpoints and dumb pipes: APIs REST, comunicação assíncrona e síncrona com transparencia na comunicação, sistema de mensageria (são dumb por que o sistema não sabe quem vai receber a mensagem que ele está enviando)
    - Governança decentralizada: Ferramenta certa para o trabalho certo, varia por que é preciso não variar por variar.
    - Automação de infraestrutura: Tem que ser rápida toda a integração: teste automatizado, CI/CD, load ballance, 
    - Desenhado para falhar: Desenhar planos de fallback para caso esse microserviço cair. Log e monitoramento em tempo real.
    - Design Evolutivo: Produtos sempre podem ser evoluídos, alterados ou melhorados. Pode ser substituído sem afetar o resto do sistema.

#### API gateways 

Recebe as chamadas das API então roteia para o microserviço correspondente (podem ter regras de negócio antes do roteamento). A grande diferença do ESB é que o ESB é feito para comunicação entre serviços (os serviços só se comunicam com o ESB) e o gateway é feito para o cliente (o sistema do cliente recebe a requisição e envia para o microserviço correspondente)

#### Service discovery

Provê meios de descobrimento do serviço e suas instâncias. Busca os serviços disponíveis, podem ser comunicados com o cliente diretamente ou com um load balancer. 
- Ferramentas populares: Netflix Eureka, Consul (bem simples e feito em Go), Etcd, ZooKeeper
O Kubernetes faz o service discovery automaticamente.

#### Comunicação entre microserviços

Pode ser síncrona ou assíncrona. A comunicação melhor é com a ajuda de mensagerias, que vai colocar em filas todas as requisições de um serviço para outro e mesmo que um serviço esteja fora ele vai guardar para execução.

- RabbitMQ é um sistema mais famoso de mensagerias. Apache Kafka é um outro bem usado também.
    - Tipo de mensagens: Fanout (envio de uma mensagem para todas as filas), binding keys (envio de mensagem para um fila específica) 
    - Dupla latência: Há muita comunicação e isso pode tornar o sistema lento. 

#### BFF (Backend for Frontend)

Tenho diversos dispositivos na Internet e eles fazem requisições. Porém no Browser as possibilidades são maiores para exibir mais informações. Cada front-end (dispositivo) vai requisitar um tanto de informação, então cada requisição só vai trazer o necessário para o dispositivo.




