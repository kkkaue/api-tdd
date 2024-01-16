# API TDD

- [x] Salvar um endpoint
  - [x] Precisar enviar o endpoint que queremos encurtar
  - [x] Endpoint tem que ser válido
  - [x] Não pode se repetir
  - [x] Esperamos receber uma url encurtada pdl.test/YH21
  - [x] Esperamos receber um status code 201
- [x] Deletar a url curta baseado na url gerada
  - [x] url precisa existir
  - [x] receber um 204[No Content] caso deletado com sucesso
- [x] Pegar estatística de uso da url /stats/YH21
  - [x] ultima vez que foi utilizada

```json
{
  "last_visit": "2022-02-17T13:45:00",
}
```

  - [x] receber quantas vezes a url foi utilizada

```json
{
  "daily_stats": [
    {
      "day": "2022-02-16",
      "qty": 20
    },
    {
      "day": "2022-02-17",
      "qty": 10
    }
  ],
  "total": 30
}
```
