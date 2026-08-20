# Regras de Negócio

## RN01 - Cadastro de Equipamento

Todo equipamento cadastrado inicia com o status:

"Aguardando Calibração"

---

## RN02 - Primeira Calibração

Após o registro da primeira calibração aprovada, o equipamento muda automaticamente para:

"Em Operação"

---

## RN03 - Alerta de Vencimento

O sistema deverá avisar quando faltarem 30 dias para o vencimento da calibração.

---

## RN04 - Calibração Vencida

Se a data da próxima calibração for ultrapassada, o equipamento será marcado como:

"Calibração Vencida"

---

## RN05 - Falha

Quando ocorrer uma falha, o equipamento deverá ser colocado em:

"Quarentena"

---

## RN06 - Manutenção

Após manutenção, o equipamento deverá voltar para:

"Aguardando Calibração"

---

## RN07 - Recalibração

Após uma nova calibração aprovada, o equipamento retorna para:

"Em Operação"

---

## RN08 - Histórico

Nenhuma calibração poderá ser apagada.

Todo histórico deverá permanecer armazenado.

---

## RN09 - Certificados

Cada calibração poderá possuir um certificado em PDF.

---

## RN10 - Rastreabilidade

Todas as alterações deverão permanecer registradas no histórico do equipamento.