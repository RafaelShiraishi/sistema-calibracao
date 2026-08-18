# Modelo Conceitual do Banco de Dados

## Tabela: usuarios

Responsável pelo acesso ao sistema.

Campos:

- id
- nome
- email
- senha
- perfil

---

## Tabela: fabricantes

Responsável pelo cadastro dos fabricantes.

Campos:

- id
- nome
- pais

---

## Tabela: laboratorios

Responsável pelos laboratórios de calibração.

Campos:

- id
- nome
- cnpj
- contato
- email

---

## Tabela: equipamentos

Responsável pelo cadastro dos equipamentos.

Campos:

- id
- patrimonio
- nome
- fabricante_id
- modelo
- numero_serie
- localizacao
- data_aquisicao
- status

---

## Tabela: calibracoes

Histórico de todas as calibrações.

Campos:

- id
- equipamento_id
- laboratorio_id
- data_calibracao
- proxima_calibracao
- certificado_pdf
- observacoes

---

## Tabela: historico_eventos

Responsável pela rastreabilidade completa.

Campos:

- id
- equipamento_id
- usuario_id
- data_evento
- tipo_evento
- descricao