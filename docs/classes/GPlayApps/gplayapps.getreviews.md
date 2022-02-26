[Documentation](../../README.md) > [GPlayApps](README.md) > **getReviews**

# Nelexa\GPlay\GPlayApps::getReviews
`Nelexa\GPlay\GPlayApps::getReviews` — Returns reviews of the Android app in the Google Play store.

## Description
```php
Nelexa\GPlay\GPlayApps::getReviews ( string | Nelexa\GPlay\Model\AppId $appId [, int $limit = 100 ] [, Nelexa\GPlay\Enum\SortEnum | null $sort = null ] ) : Nelexa\GPlay\Model\Review[]
```
Getting a lot of reviews can take a lot of time.

## Parameters
* **$appId** (string | [Nelexa\GPlay\Model\AppId](../AppId/README.md))  
application ID (Android package name) as
a string or [Nelexa\GPlay\Model\AppId](../AppId/README.md) object
* **$limit** (int)  
Maximum number of reviews. To extract all
reviews, use [Nelexa\GPlay\GPlayApps::UNLIMIT](README.md#predefined-constants).
* **$sort** ([Nelexa\GPlay\Enum\SortEnum](../SortEnum/README.md) | null)  
Sort reviews of the application.
If null, then sort by the newest reviews.

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
      -getId(): string: "gp:AOqpTOGobbFWlkxiu3je21EbN0izjZYCj888IJdkBfysY5aNS-hIsIsFVc_6yDusSX6MHpWUQsNT-MdlqPgMKG8"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=ru.yandex.metro&reviewId=gp%3AAOqpTOGobbFWlkxiu3je21EbN0izjZYCj888IJdkBfysY5aNS-hIsIsFVc_6yDusSX6MHpWUQs…"
      -getUserName(): string: "Татьяна Борисова"
      -getText(): string: "Удобное приложение. Всё варианты пересадок и время в пути показывает, временные закрытия станций - тоже. Это про Московское метро. Но схемы есть и дру…"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/a/AATXAJz1CMv1CYyC64JggEWAkCwXOZBlgU4DakbQKRLo=s64"
        -getUrl(): string: "https://play-lh.googleusercontent.com/a/AATXAJz1CMv1CYyC64JggEWAkCwXOZBlgU4DakbQKRLo=s64"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a/AATXAJz1CMv1CYyC64JggEWAkCwXOZBlgU4DakbQKRLo=s0"
        -getBinaryImageContent(): string: …
      }
      -getDate(): ?DateTimeInterface: @1645609417 {
        date: 2022-02-23T09:43:37+00:00
      }
      -getScore(): int: 5
      -getCountLikes(): int: 0
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: {
        -getDate(): DateTimeInterface: @1645612425 {
          date: 2022-02-23T10:33:45+00:00
        }
        -getText(): string: "Татьяна, спасибо, что пользуетесь сервисами Яндекса! Мы очень ценим ваше доверие и рады, что приложение оказалось полезным для вас."
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOGYqhgzbm47kLyxoHYlFHzF2v4k94k7i0ySzz43DWTQPIr5pLXrNBA5UL78PD0sk2stVg71MWKay-Jmpl8"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=ru.yandex.metro&reviewId=gp%3AAOqpTOGYqhgzbm47kLyxoHYlFHzF2v4k94k7i0ySzz43DWTQPIr5pLXrNBA5UL78PD0sk2stVg…"
      -getUserName(): string: "Анна Батлер"
      -getText(): string: "Очень удобное приложение , показывает в какой вагон удобнее сесть для перехода на другую ветку, сколько времени займет переход , в том числе и наземны…"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/a/AATXAJySgKDLGlL5yp4zPkFC6CnajA2YXlXxsQNig7jh=s64"
        -getUrl(): string: "https://play-lh.googleusercontent.com/a/AATXAJySgKDLGlL5yp4zPkFC6CnajA2YXlXxsQNig7jh=s64"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a/AATXAJySgKDLGlL5yp4zPkFC6CnajA2YXlXxsQNig7jh=s0"
        -getBinaryImageContent(): string: …
      }
      -getDate(): ?DateTimeInterface: @1645708636 {
        date: 2022-02-24T13:17:16+00:00
      }
      -getScore(): int: 5
      -getCountLikes(): int: 0
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: {
        -getDate(): DateTimeInterface: @1645740299 {
          date: 2022-02-24T22:04:59+00:00
        }
        -getText(): string: "Анна, спасибо вам за оценку! Мы рады, что вам нравится наше приложение :)"
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
```

</details>

## See Also
* [Nelexa\GPlay\Enum\SortEnum](../SortEnum/README.md) - Contains all valid values for the "sort" parameter.
* [Nelexa\GPlay\GPlayApps::UNLIMIT](README.md#predefined-constants) - Limit for all available results.

[Documentation](../../README.md) > [GPlayApps](README.md) > **getReviews**
