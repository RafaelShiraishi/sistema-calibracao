# Modelo Entidade-Relacionamento (MER)

## Entidades

- Usuários
- Setores
- Fabricantes
- Laboratórios
- Equipamentos
- Calibrações
- Manutenções
- Histórico
- Anexos

## Relacionamentos

Fabricante (1) -------- (N) Equipamentos

Setor (1) -------- (N) Equipamentos

Equipamento (1) -------- (N) Calibrações

Laboratório (1) -------- (N) Calibrações

Usuário (1) -------- (N) Calibrações

Equipamento (1) -------- (N) Manutenções

Usuário (1) -------- (N) Manutenções

Equipamento (1) -------- (N) Histórico

Usuário (1) -------- (N) Histórico

Calibração (1) -------- (N) Anexos

Manutenção (1) -------- (N) Anexos

Equipamento (1) -------- (N) Anexos