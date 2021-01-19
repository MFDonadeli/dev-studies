# Integração Contínua (CI)

Processo de integrar modificações no codebase de forma contínua e automatizada, evitando erros humanos, por exemplo, se eu quero adicionar alguma feature no projeto, eu preciso fazer uma pull-request e fazer o desenvolvimento disto, porém, se eu realizar todas as verificações, testes e integração com o código básico manualmente eu posso ficar louco

## Principais Processos

- Testes, 
- Linter, 
- qualidade de código, 
- segurança, 
- geração de artefatos prontos para o processo de deploy, 
- identificação da próxima versão
- geração de tags e releases

## Ferramentas populares

- Jenkins
- Github Actions (Automatizador de workflow de desenvolvimento de software, é iniciado baseado em eventos do Github ou agendamento)
- Circle CI
- AWS Code Build
- Azure DevOps
- Google Cloud Build
- GitLab Pipelines / CI

## GitHub Actions

Uma action é uma ação que roda em um dos steps de um job em um workflow, pode ser desenvolvida em Javascript ou Docker ou usar prontas no MarketPlace do GitHub

### Como usar

Criar um programa qualquer e criar um repositório Git, fazendo todos os passos padrões: git init, git add, git commit -m "feat: Adicionado xxx", (se tiver com a assinatura ativada não esquece de ativar o gpg: gpgconf --launch gpg-agent), git branch -M main, git remote add, git push -u origin main

#### criar o workflow

Criar um diretorio na aplicação .github/workflows e criar um ci.yaml
actions/setup: é um repositório setup do usuário actions

```
name: <nome do workflow>
on: [push] <- vai executar toda vez que der um git push no repositório
jobs:
    check-application: 
        runs-on: ubuntu-latest <- vai rodar sobre uma imagem ubuntu
        steps:
            - uses: actions/checkout@v2 <- pega o que eu acabei de subir e baixa na máquina ubuntu
            - uses: actions/setup-go@v2 <- prepara o ambiente go
              with:
                go-version: 1.15 <- qual versão do go
            - run: go test
            - run: go run math.go <- roda o go
```

Não esqueça de comitar este novo arquivo: "git commit -m "ci: Add github actions for every push""

Assim que subir (push) no Github e eu for na aba Actions, eu vou ver que a Action já foi executada

### trabalhando com pullrequests

Crio meu branch de develop: git checkout -b develop e modifico o caminho: git push origin develop

Mudo meu branch padrão para develop (em settings no Github) e em Branch Protection Rule, marque a opção "Require status checks to pass before merging" e eu preciso indicar qual é o check (no caso será check-application que eu criei dentro do meu ci.yaml). Cheque também que Require branches to be up to date before merging

Eu vou querer que os merges sejam feitos somente no meu develop, para isso eu vou modificar o meu ci.yaml

```
name: <nome do workflow>
on: 
    pull_request:
        branches: 
            - develop <- toda vez que eu fizer um pull_request no meu branches develop
jobs:
    check-application: 
        runs-on: ubuntu-latest <- vai rodar sobre uma imagem ubuntu
        steps:
            - uses: actions/checkout@v2 <- pega o que eu acabei de subir e baixa na máquina ubuntu
            - uses: actions/setup-go@v2 <- prepara o ambiente go
              with:
                go-version: 1.15 <- qual versão do go
            - run: go test
            - run: go run math.go <- roda o go
```

Agora eu posso colocar meu código no github dando um push: git push origin develop (não faça isso pois vai dar erro)
Tem que criar a pull-request: git checkout -b feature/ci, git push origin feature/ci

Quando tentar dar o merge ele não vai deixar pois tem que passar os actions

E agora, passando o actions, sobe tudo para o develop: git checkout develop, git pull origin develop, git branch -d feature/ci (apaga o branch)

### Gerando uma pull request e também uma imagem Docker da imagem que foi criado


```
name: <nome do workflow>
on: 
    pull_request:
        branches: 
            - develop <- toda vez que eu fizer um pull_request no meu branches develop
jobs:
    check-application: 
        runs-on: ubuntu-latest <- vai rodar sobre uma imagem ubuntu
        steps:
            - uses: actions/checkout@v2 <- pega o que eu acabei de subir e baixa na máquina ubuntu
            - uses: actions/setup-go@v2 <- prepara o ambiente go
              with:
                go-version: 1.15 <- qual versão do go
            - run: go test
            - run: go run math.go <- roda o go
            - name: Set up QEMU <- A partir daqui vai simular uma máquina com linux para fazer o build do docker
              uses: docker/setup-qemu-action@v1

            - name: Set up Docker Buildx
              uses: docker/setup-buildx-action@v1

            - name: Login to DockerHub <- Aqui  vai enviar a imagem para o Dockerhub
              uses: docker/login-action@v1 
              with:
                username: ${{ secrets.DOCKERHUB_USERNAME }} <- Esses secrets são configurados dentro do github
                password: ${{ secrets.DOCKERHUB_TOKEN }}

            - name: Build and push
              id: docker_build
              uses: docker/build-push-action@v2
              with:
                push: true <- Faz o build da image e também envia para o dockerhub
                tags: wesleywillians/fc2.0-ci-go:latest
```
