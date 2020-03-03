# Описание методов REST API

**Фирма**
```
api/v1/companies                     Список всех фирм
api/v1/companies/1                   Фирма с id=1
api/v1/companies/1?expand=rubrics    дополнительные поля (rubrics)
```

**Рубрика**
```
api/v1/rubrics                      Список рубрик
api/v1/rubrics/1                    Рубрика с id=1
api/v1/building/1?expand=company    Все фирмы с заданной рубрикой
```

**Дополнительные параметры**
```
?expand=firms,rubrics,          Вывод дополнительных полей (выводятся как в списке, так и для одного экземпляра)
?fileds=name,id                 Определяет какие именно поля выводить
```