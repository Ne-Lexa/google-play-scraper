# Nelexa\GPlay\GPlayApps::getReviews
`Nelexa\GPlay\GPlayApps::getReviews` — Returns reviews of the Android app in the Google Play store.

## Description
```php
Nelexa\GPlay\GPlayApps::getReviews ( string | Nelexa\GPlay\Model\AppId $appId [, int $limit = 100 ] [, Nelexa\GPlay\Enum\SortEnum | null $sort = null ] ) : Nelexa\GPlay\Model\Review[]
```
Getting a lot of reviews can take a lot of time.

## Parameters
* **$appId** (string | [Nelexa\GPlay\Model\AppId](../AppId/README.md))  
application ID (Android package name) as a string or [Nelexa\GPlay\Model\AppId](../AppId/README.md) object
* **$limit** (int)  
Maximum number of reviews. To extract all reviews, use [Nelexa\GPlay\GPlayApps::UNLIMIT](README.md#predefined-constants).
* **$sort** ([Nelexa\GPlay\Enum\SortEnum](../SortEnum/README.md) | null)  
Sort reviews of the application. If null, then sort by the newest reviews.

## Return Values
app reviews


## Errors/Exceptions
* Throws [Nelexa\GPlay\Exception\GooglePlayException](../GooglePlayException/README.md) if the application is not exists or other HTTP error
## Examples
**Example 1**
```php
$appId = 'ru.yandex.metro';
// or
$appId = new \Nelexa\GPlay\Model\AppId('ru.yandex.metro', 'ru');

$reviews = $gplay->getReviews(
    $appId,
    $limit = 1000,
    $sort = \Nelexa\GPlay\Enum\SortEnum::HELPFULNESS()
);
```
<details>
  <summary>Results</summary>

```php
array:1000 [
    0 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOGXiWwiyPHHUCXsx5JPJtDtKIa7CCXTUK8xhAJ9eyNv_jkm4coeSOqKHn3Eu5s52AMTOvPLPL0RbAJV25Y"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=ru.yandex.metro&reviewId=gp%3AAOqpTOGXiWwiyPHHUCXsx5JPJtDtKIa7CCXTUK8xhAJ9eyNv_jkm4coeSOqKHn3Eu5s52AMTOv…"
      -getUserName(): string: "Рии Эн"
      -getText(): string: "Диаметры то появляются, то исчезают. Время отличается от рассчитанного на сайте. Предлагает ехать через закрытую каховскую ветку. Единственное, что ра…"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/-Zos3KoSJTjU/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rfZKhn84y4kq0BVajR1VBK8JSNuFQ/s64/"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/-Zos3KoSJTjU/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rfZKhn84y4kq0BVajR1VBK8JSNuFQ/s0/"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/-Zos3KoSJTjU/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rfZKhn84y4kq0BVajR1VBK8JSNuFQ/s64/"
      }
      -getDate(): ?DateTimeInterface: @1581341597 {
        date: 2020-02-10T13:33:17+00:00
      }
      -getScore(): int: 3
      -getCountLikes(): int: 0
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: {
        -getDate(): DateTimeInterface: @1581359256 {
          date: 2020-02-10T18:27:36+00:00
        }
        -getText(): string: "Пожалуйста, напишите нам на app-metro@support.yandex.ru или через меню «Настройки» — «Обратная связь», покажите на скриншотах ситуации, которые вызыва…"
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    1 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOG_xA95u0_lmV3wsgCsQtowloGBgg6npK5MD_dHWE1dFhsFsZXU6SlHjZGHdIZhvVUfyhhCjDAzBPOfSuA"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=ru.yandex.metro&reviewId=gp%3AAOqpTOG_xA95u0_lmV3wsgCsQtowloGBgg6npK5MD_dHWE1dFhsFsZXU6SlHjZGHdIZhvVUfyh…"
      -getUserName(): string: "Андрей Жигалов"
      -getText(): string: "После пополнения карты, запись ден. средств на карту происходит только раза с восьмого. Постоянно ошибки какие-то. Приложение удобное, но работает не …"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/-djEIryva90g/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rcNhSmP66ktNvsWeLcIEBM59ypA9g/s64/"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/-djEIryva90g/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rcNhSmP66ktNvsWeLcIEBM59ypA9g/s0/"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/-djEIryva90g/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rcNhSmP66ktNvsWeLcIEBM59ypA9g/s64/"
      }
      -getDate(): ?DateTimeInterface: @1580965709 {
        date: 2020-02-06T05:08:29+00:00
      }
      -getScore(): int: 3
      -getCountLikes(): int: 2
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: {
        -getDate(): DateTimeInterface: @1581004502 {
          date: 2020-02-06T15:55:02+00:00
        }
        -getText(): string: "Пожалуйста, напишите нам о ситуации на geopay@support.yandex.ru. Обязательно всё проверим."
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    …
  ]
```

</details>

## See Also
* [Nelexa\GPlay\Enum\SortEnum](../SortEnum/README.md) - Contains all valid values for the "sort" parameter.
* [Nelexa\GPlay\GPlayApps::UNLIMIT](README.md#predefined-constants) - Limit for all available results.
