# Readme 📜

Bem-vindo(a) ao **Projeto Blog MentalAid**!

## Subindo o projeto ☕️

Para executar o projeto basta executar em seu terminal
```shell
docker compose up -d
```

Para gerar o backup do banco de dados basta executar em seu terminal
```shell
docker exec mysql-db mysqldump -uroot --password=1234 blog > backup.sql
```

Para restaurar o banco de dados basta executar em seu terminal
```shell
docker compose exec db sh -c "mysql -uroot -p1234 blog < /var/tmp/backup.sql"
```

Para logar na aplicação utilizar o e-mail: 

Email: fiap@fiap.com
Senha: 123456

ou

Email: admin@admin.com.br
Senha: 1234


Importante: não segui os nomes dos arquivos, porque não tinha lido que teria que seguir exatamente cada nome, fui construindo
conforme cada tela apresentada no wireframe e o fluxo da comunidade de escrever tudo em ingles,
adicionei o composer para poder utilizar as classes e manter separado as responsabilidades.

Link: https://github.com/FelipeRochaOl/logbook