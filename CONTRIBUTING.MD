# 🧑‍💻 Contribuindo com o GymManager

Olá! 👋 Seja bem-vindo(a) e obrigado(a) por considerar contribuir com o GymManager — um sistema de gestão de academias em desenvolvimento.

Este documento tem como objetivo orientar e padronizar as contribuições com o projeto, especialmente no que diz respeito à nomenclatura dos commits, baseada no padrão **[Conventional Commits](https://www.conventionalcommits.org/pt-br/v1.0.0/)**.

---

## 🧾 Regras de commit — Conventional Commits

Este projeto segue o padrão **Conventional Commits** para manter um histórico de mudanças claro, legível e automatizável.

### ✅ Formato de um commit válido (Sempre em inglês)

<type>(optional-scope): <short message>

[optional body]

### Exemplos (em inglês)

feat(user): add registration form for new users
fix(payment): correct calculation of late fees
docs(readme): update contributing guidelines section
refactor(auth): simplify token validation logic


### 💡 Dicas

- Use verbos no **infinitivo** (ex: "add", "fix", "remove", "update")
- Mantenha a mensagem curta e objetiva
- Utilize o escopo entre parênteses para indicar o módulo afetado (opcional)

---

## ## Tipo e descrição 

Os seguintes labels devem ser utilizados para a realização dos commits desse projeto:

- `feat` - Commits do tipo feat indicam que seu trecho de código está incluindo um **novo recurso** (se relaciona com o MINOR do versionamento semântico).

- `fix` - Commits do tipo fix indicam que seu trecho de código commitado está **solucionando um problema** (bug fix), (se relaciona com o PATCH do versionamento semântico).

- `docs` - Commits do tipo docs indicam que houveram **mudanças na documentação**, como por exemplo no Readme do seu repositório. (Não inclui alterações em código).

- `test` - Commits do tipo test são utilizados quando são realizadas **alterações em testes**, seja criando, alterando ou excluindo testes unitários. (Não inclui alterações em código)

- `build` - Commits do tipo build são utilizados quando são realizadas modificações em **arquivos de build e dependências**.

- `perf` - Commits do tipo perf servem para identificar quaisquer alterações de código que estejam relacionadas a **performance**.

- `style` - Commits do tipo style indicam que houveram alterações referentes a **formatações de código**, semicolons, trailing spaces, lint... (Não inclui alterações em código).

- `refactor` - Commits do tipo refactor referem-se a mudanças devido a **refatorações que não alterem sua funcionalidade**, como por exemplo, uma alteração no formato como é processada determinada parte da tela, mas que manteve a mesma funcionalidade, ou melhorias de performance devido a um code review.

- `chore` - Commits do tipo chore indicam **atualizações de tarefas** de build, configurações de administrador, pacotes... como por exemplo adicionar um pacote no gitignore. (Não inclui alterações em código)

- `ci` - Commits do tipo ci indicam mudanças relacionadas a **integração contínua** (_continuous integration_).

- `raw` - Commits do tipo raw indicam mudanças relacionadas a arquivos de configurações, dados, features, parâmetros.

- `cleanup` - Commits do tipo cleanup são utilizados para remover código comentado, trechos desnecessários ou qualquer outra forma de limpeza do código-fonte, visando aprimorar sua legibilidade e manutenibilidade.

- `remove` - Commits do tipo remove indicam a exclusão de arquivos, diretórios ou funcionalidades obsoletas ou não utilizadas, reduzindo o tamanho e a complexidade do projeto e mantendo-o mais organizado.

---

## ✍️ Como contribuir

1. Faça um **fork** do repositório
2. Crie uma branch com a sua feature ou correção: `git checkout -b feat/new-feature`
3. Faça seus commits seguindo o padrão descrito acima
4. Envie um **pull request** para a branch `main` com uma descrição clara do que foi feito

---

## 💬 Dúvidas?

Caso tenha alguma dúvida, sugestão ou queira discutir alguma melhoria, sinta-se à vontade para abrir uma **issue** no repositório.

Obrigado por contribuir! 🚀


