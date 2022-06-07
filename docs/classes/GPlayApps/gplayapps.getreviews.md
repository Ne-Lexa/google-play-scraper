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
      -getId(): string: "gp:AOqpTOGMQH49VsMM5PMKe-d6SYrxGzo-sFQ9Apr2Q0ROtv1rx8BidV3yU5pz9WKf3sJnHZ4tzAoBmembGkyaUNY"
      -getUrl(): mixed: ""
      -getUserName(): string: "Анатолий Котеленец"
      -getText(): string: "Отличное приложение. Теперь написанно сколько будет на такси стоить ))) Люди пишут по поводу GPS навигации со одной стороны это было бы отлично. С дру…"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14Gg2Yaj5bSn60zXWgPouzpVkbzDZvyHaNJR8Uwm1lw=s64"
        -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14Gg2Yaj5bSn60zXWgPouzpVkbzDZvyHaNJR8Uwm1lw=s64"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14Gg2Yaj5bSn60zXWgPouzpVkbzDZvyHaNJR8Uwm1lw=s0"
        -getBinaryImageContent(): string: …
      }
      -getDate(): ?DateTimeInterface: @1653108314 {
        date: 2022-05-21T04:45:14+00:00
      }
      -getScore(): int: 5
      -getCountLikes(): int: 50
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: {
        -getDate(): DateTimeInterface: @1653293986 {
          date: 2022-05-23T08:19:46+00:00
        }
        -getText(): string: "Анатолий, спасибо, что пользуетесь сервисами Яндекса! Мы очень ценим ваше доверие и рады, что приложение оказалось полезным для вас."
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getAppVersion(): ?string: "3.6.4"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOENZ-EPam3izLvzWuxR2PkIVfqVoQv8OOyCNwz76SssaO5XDXNJKhDMEcRIlY1wqm-gklLbCtVnRclmeUU"
      -getUrl(): mixed: ""
      -getUserName(): string: "Сергей"
      -getText(): string: "Реклама в схеме метро, которая закрывает саму схему и которую нельзя отключить - это изобретение садиста. Re: Стараетесь, чтобы было ненавязчиво? А ес…"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14Gg7TaltJFqmYQfvOZW9sjEIegbuBFBlBb_PMP2hSg=s64"
        -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14Gg7TaltJFqmYQfvOZW9sjEIegbuBFBlBb_PMP2hSg=s64"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14Gg7TaltJFqmYQfvOZW9sjEIegbuBFBlBb_PMP2hSg=s0"
        -getBinaryImageContent(): string: …
      }
      -getDate(): ?DateTimeInterface: @1652507283 {
        date: 2022-05-14T05:48:03+00:00
      }
      -getScore(): int: 1
      -getCountLikes(): int: 80
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: {
        -getDate(): DateTimeInterface: @1652677566 {
          date: 2022-05-16T05:06:06+00:00
        }
        -getText(): string: "Сергей, понимаем, что подобное поведение приложения вас расстраивает. Действительно, сейчас в Яндекс Метро нет возможности отключить рекламу. Мы внима…"
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getAppVersion(): ?string: "3.6.4"
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
