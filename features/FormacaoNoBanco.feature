#language: pt
Funcionalidade: Cadastro de formações
    Eu, como instrutor
    Quero cadastrar formações
    Para organizar meus cursos

    Regras:
        - Formação precisa ter uma descrição
        - Descrição da formação precisa ter ao menos duas palavras

    @integracao
    Cenário:
        Dado que estou connectado ao banco de dados
        Quando tento salvar uma formação com a descrição "PHP na Web"
        Então se eu buscar no banco, devo encontrar essa formação
