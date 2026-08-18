# Sistema de Gerenciamento de Calibração

## Objetivo

Desenvolver um sistema web para gerenciamento do ciclo de vida de equipamentos de medição, permitindo cadastro, controle de calibrações, histórico, alertas de vencimento e rastreabilidade.

---

# Objetivos Específicos

- Cadastrar equipamentos
- Cadastrar fabricantes
- Cadastrar laboratórios
- Registrar calibrações
- Controlar o status dos equipamentos
- Emitir alertas de vencimento
- Armazenar certificados de calibração
- Consultar histórico de calibrações

---

# Fluxo do Equipamento

Cadastro

↓

Aguardando Calibração

↓

Calibração Inicial

↓

Em Operação

↓

Alerta de Vencimento

↓

Nova Calibração

↓

Em Operação

↓

Falha

↓

Quarentena

↓

Manutenção

↓

Nova Calibração

↓

Em Operação

---

# Módulos

## Login

- Login
- Logout
- Controle de Sessão

---

## Dashboard

- Quantidade de equipamentos
- Equipamentos em operação
- Equipamentos em quarentena
- Equipamentos próximos do vencimento
- Equipamentos vencidos

---

## Equipamentos

- Cadastro
- Consulta
- Alteração
- Exclusão

---

## Fabricantes

- Cadastro
- Consulta

---

## Laboratórios

- Cadastro
- Consulta

---

## Calibrações

- Registro
- Histórico
- Upload do certificado PDF

---

## Relatórios

- Equipamentos
- Calibrações
- Equipamentos vencidos