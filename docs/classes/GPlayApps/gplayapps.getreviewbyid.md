[Documentation](../../README.md) > [GPlayApps](README.md) > **getReviewById**

# Nelexa\GPlay\GPlayApps::getReviewById
`Nelexa\GPlay\GPlayApps::getReviewById` — Returns review of the Android app in the Google Play store by review id.

## Description
```php
Nelexa\GPlay\GPlayApps::getReviewById ( string | Nelexa\GPlay\Model\AppId $appId , string $reviewId ) : Nelexa\GPlay\Model\Review
```

## Parameters
* **$appId** (string | [Nelexa\GPlay\Model\AppId](../AppId/README.md))  
application ID (Android package name) as a string or [Nelexa\GPlay\Model\AppId](../AppId/README.md) object
* **$reviewId** (string)  
review id

## Return Values
app review


## Errors/Exceptions
* Throws [Nelexa\GPlay\Exception\GooglePlayException](../GooglePlayException/README.md) if the application is not exists or other HTTP error
## Examples
**Example 1**
```php
$appId = 'com.viber.voip';
// or
$appId = new \Nelexa\GPlay\Model\AppId('com.viber.voip');

$review = $gplay->getReviewById(
    $appId,
    $reviewId = 'gp:AOqpTOGkxfRp2B9_nud4zNgpwZ3L5ZHhjm2Bl7hNSeX2LkYTLL7rhkrNmnPPvtecH8Sg5mpWlU2_569ktUzNRjY'
);
```
<details>
  <summary>Results</summary>

```php
class Nelexa\GPlay\Model\Review {
  -getId(): string: "gp:AOqpTOGkxfRp2B9_nud4zNgpwZ3L5ZHhjm2Bl7hNSeX2LkYTLL7rhkrNmnPPvtecH8Sg5mpWlU2_569ktUzNRjY"
  -getUrl(): string: "https://play.google.com/store/apps/details?id=com.viber.voip&reviewId=gp%3AAOqpTOGkxfRp2B9_nud4zNgpwZ3L5ZHhjm2Bl7hNSeX2LkYTLL7rhkrNmnPPvtecH8Sg5mpWlU2…"
  -getUserName(): string: "rih"
  -getText(): string: "images are not saved on gallery even though it is in automatic download mode. fix this problem fast."
  -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
    -getUrl(): string: "https://lh3.googleusercontent.com/-7fis3zoKasI/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rcxiuziW9IC_qbC3i_TPbxOkpmx5A/s64/"
    -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/-7fis3zoKasI/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rcxiuziW9IC_qbC3i_TPbxOkpmx5A/s0/"
    -getBinaryImageContent(): string: …
    -__toString(): string: "https://lh3.googleusercontent.com/-7fis3zoKasI/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rcxiuziW9IC_qbC3i_TPbxOkpmx5A/s64/"
  }
  -getDate(): ?DateTimeInterface: @1581236842 {
    date: 2020-02-09T08:27:22+00:00
  }
  -getScore(): int: 1
  -getCountLikes(): int: 2
  -getReply(): ?Nelexa\GPlay\Model\ReplyReview: {
    -getDate(): DateTimeInterface: @1581348449 {
      date: 2020-02-10T15:27:29+00:00
    }
    -getText(): string: """
      Hello, \n
      Thank you for letting us know, please also provide our support team this information allowing us to investigate it and assist you as soon as p…
      """
    -asArray(): array: …
    -jsonSerialize(): mixed: …
  }
  -asArray(): array: …
  -jsonSerialize(): mixed: …
}
```

</details>

[Documentation](../../README.md) > [GPlayApps](README.md) > **getReviewById**
