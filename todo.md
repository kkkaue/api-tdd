# API TDD

- [ ] Salvar um endpoint
  - [x] Precisar enviar o endpoint que queremos encurtar
  - [ ] Endpoint tem que ser válido
  - [ ] Não pode se repetir
  - [ ] Esperamos receber uma url encurtada pdl.test/YH21
  - [ ] Esperamos receber um status code 201
- [ ] Deletar a url curta baseado na url gerada
  - [ ] url precisa existir
  - [ ] receber um 204[No Content] caso deletado com sucesso
- [ ] Pegar estatística de uso da url /stats/YH21
  - [ ] ultima vez que foi utilizada

```json
{
  "last_access": "2022-02-17T13:45:00",
}
```
