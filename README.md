# Deliver IT - API

## Instalação

- ```git clone https://github.com/marcaum54/deliver-it-api.git```
- ```cd deliver-it-api```
- ```composer install```
- ```cp .env.example .env```
    - Verifique as informações de configurações contidas no ``.env`` correspondem ao seu ambiente.
- ```php artisan key:generate```
- ```php artisan migrate --seed```
- ```php artisan serve```

## Endpoints

## GET /
> &nbsp;
>
> Rota para home, só para ver se a api está Online
>
> **Response**
>
> _Status: 200 (text/plain)_
>
> &nbsp;

## POST /prova
> &nbsp;
>
> Cadastrar uma nova Prova
>
> **Parâmetros**
>
> - tipo (Valores aceitos: '3KM', '5KM', '10KM', '21KM', '42KM')
> - data
>
> **Response**
>
> _Status: 201 (application/json)_
>
> &nbsp;

## POST /corredor
> &nbsp;
>
> Cadastrar um novo Corredor
>
> **Parâmetros**
>
> - nome
> - cpf
> - data_nascimento
>
> **Response**
>
> _Status: 201 (application/json)_
>
> &nbsp;

## POST /inscricao
> &nbsp;
>
> Cadastrar a inscrição de um Corredor em uma Prova
>
> **Parâmetros**
>
> - prova_id
> - corredor_id
>
> **Response**
>
> _Status: 201 (application/json)_
>
> &nbsp;

## POST /resultado
> &nbsp;
>
> Cadastrar a hora de largada e chegada de um Corredor em uma Prova
>
> **Parâmetros**
>
> - prova_id
> - corredor_id
> - hora_ini
> - hora_fim
>
> **Response**
>
> _Status: 201 (application/json)_
>
> &nbsp;

## GET /resultado/geral
> &nbsp;
>
> Lista a performace de todos os corredores em suas respectivas prova, ordenando por sua colocação na prova, agrupado por Tipo de Prova
>
> **Response**
>
> _Status: 200 (application/json)_
>
> &nbsp;

## GET /resultado/por-idade
> &nbsp;
>
> Lista a performace de todos os corredores em suas respectivas prova, ordenando por sua colocação na prova, agrupado por idade e seguido e um agrupamento por Tipo de Prova
>
> **Response**
>
> _Status: 200 (application/json)_
>
> &nbsp;

