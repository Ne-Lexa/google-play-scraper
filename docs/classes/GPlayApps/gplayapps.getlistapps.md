[Documentation](../../README.md) > [GPlayApps](README.md) > **getListApps**

# Nelexa\GPlay\GPlayApps::getListApps
`Nelexa\GPlay\GPlayApps::getListApps` — Returns an array of applications from the Google Play store for the specified category.

## Description
```php
Nelexa\GPlay\GPlayApps::getListApps ( [ string | Nelexa\GPlay\Model\Category | Nelexa\GPlay\Enum\CategoryEnum | null $category = null ] [, Nelexa\GPlay\Enum\AgeEnum | null $age = null ] [, int $limit = -1 ] ) : Nelexa\GPlay\Model\App[]
```
[Nelexa\GPlay\Enum\CategoryEnum](../CategoryEnum/README.md) or
`null` for all categories

## Parameters
* **$category** (string | [Nelexa\GPlay\Model\Category](../Category/README.md) | [Nelexa\GPlay\Enum\CategoryEnum](../CategoryEnum/README.md) | null)  
application category as
string, [Nelexa\GPlay\Model\Category](../Category/README.md),
* **$age** ([Nelexa\GPlay\Enum\AgeEnum](../AgeEnum/README.md) | null)  
age limit or null for no limit
* **$limit** (int)  
limit on the number of results
or [Nelexa\GPlay\GPlayApps::UNLIMIT](README.md#predefined-constants)
for no limit

## Return Values
an array of applications with basic information


## Errors/Exceptions
* Throws [Nelexa\GPlay\Exception\GooglePlayException](../GooglePlayException/README.md)
## Examples
**Example 1. Gets apps by category.**
```php
$apps = $gplay->getListApps(\Nelexa\GPlay\Enum\CategoryEnum::GAME_RACING());
```
<details>
  <summary>Results</summary>

```php
array:905 [
    "com.fingersoft.hillclimb" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.fingersoft.hillclimb"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.fingersoft.hillclimb"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.fingersoft.hillclimb&hl=en_US&gl=us"
      -getName(): string: "Hill Climb Racing"
      -getSummary(): ?string: "Race uphill to win in this offline physics based driving game!"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "7064049075652771302"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=7064049075652771302"
        -getName(): string: "Fingersoft"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/N0UxhBVUmx8s7y3F7Kqre2AcpXyPDKAp8nHjiPPoOONc_sfugHCYMjBpbUKCMlK_XUs"
        -getUrl(): string: "https://play-lh.googleusercontent.com/N0UxhBVUmx8s7y3F7Kqre2AcpXyPDKAp8nHjiPPoOONc_sfugHCYMjBpbUKCMlK_XUs"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/N0UxhBVUmx8s7y3F7Kqre2AcpXyPDKAp8nHjiPPoOONc_sfugHCYMjBpbUKCMlK_XUs=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.585985
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    "com.ea.game.nfs14_row" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.ea.game.nfs14_row"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.ea.game.nfs14_row"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.ea.game.nfs14_row&hl=en_US&gl=us"
      -getName(): string: "Need for Speed™ No Limits"
      -getSummary(): ?string: "Dominate the competition and rule the streets. Download to race now!"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "6605125519975771237"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=6605125519975771237"
        -getName(): string: "ELECTRONIC ARTS"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/3D39RIkfs0amH9MhhWRLHRILBQUmq1BlIqYMyNSJKb7HyqU6NhQR-toUMmSnPAi60t0"
        -getUrl(): string: "https://play-lh.googleusercontent.com/3D39RIkfs0amH9MhhWRLHRILBQUmq1BlIqYMyNSJKb7HyqU6NhQR-toUMmSnPAi60t0"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/3D39RIkfs0amH9MhhWRLHRILBQUmq1BlIqYMyNSJKb7HyqU6NhQR-toUMmSnPAi60t0=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.3452697
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
```

</details>

**Example 1. Gets applications from the GAMES category with an age limit of 6-8 years.**
```php
$apps = $gplay->getListApps(
    $category = \Nelexa\GPlay\Enum\CategoryEnum::GAME(),
    $ageLimit = \Nelexa\GPlay\Enum\AgeEnum::SIX_EIGHT(),
    $limit = 100
);
```
<details>
  <summary>Results</summary>

```php
array:100 [
    "com.blizzard.diablo.immortal" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.blizzard.diablo.immortal"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.blizzard.diablo.immortal"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.blizzard.diablo.immortal&hl=en_US&gl=us"
      -getName(): string: "Diablo Immortal"
      -getSummary(): ?string: "A brand new, visceral Diablo action RPG experience at your fingertips"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "8636572569301896616"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=8636572569301896616"
        -getName(): string: "Blizzard Entertainment, Inc."
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/8DtlOHx-zIncYJE-kwHnOTBXycjAzwufkuk0uad7_MzWP17auA24THldTwhEru-b-7I"
        -getUrl(): string: "https://play-lh.googleusercontent.com/8DtlOHx-zIncYJE-kwHnOTBXycjAzwufkuk0uad7_MzWP17auA24THldTwhEru-b-7I"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/8DtlOHx-zIncYJE-kwHnOTBXycjAzwufkuk0uad7_MzWP17auA24THldTwhEru-b-7I=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 0.0
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    "com.empire.warriors2.premium.epic.tower.td.defender.rush" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.empire.warriors2.premium.epic.tower.td.defender.rush"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.empire.warriors2.premium.epic.tower.td.defender.rush"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.empire.warriors2.premium.epic.tower.td.defender.rush&hl=en_US&gl=us"
      -getName(): string: "Empire Defender TD: Premium"
      -getSummary(): ?string: "Strategy Offline TD Game! Become An Epic Defender! Premium Version"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "7674514660084826148"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=7674514660084826148"
        -getName(): string: "ZITGA"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/mBk-tv2a4eqmsA9uPT_nsmL89CzNeKXk_vgb8__xxKNyC9Unb6dH2awR10NyL20hD_0"
        -getUrl(): string: "https://play-lh.googleusercontent.com/mBk-tv2a4eqmsA9uPT_nsmL89CzNeKXk_vgb8__xxKNyC9Unb6dH2awR10NyL20hD_0"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/mBk-tv2a4eqmsA9uPT_nsmL89CzNeKXk_vgb8__xxKNyC9Unb6dH2awR10NyL20hD_0=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 0.0
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
```

</details>

**Example 1. Gets applications from page https://play.google.com/store/apps**
```php
$apps = $gplay->getListApps();
```
<details>
  <summary>Results</summary>

```php
array:1277 [
    "com.zhiliaoapp.musically" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.zhiliaoapp.musically"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.zhiliaoapp.musically"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.zhiliaoapp.musically&hl=en_US&gl=us"
      -getName(): string: "TikTok"
      -getSummary(): ?string: "Join your friends and discover videos you love, only on TikTok"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "TikTok Pte. Ltd."
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=TikTok+Pte.+Ltd."
        -getName(): string: "TikTok Pte. Ltd."
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/z5nin1RdQ4UZhv6fa1FNG7VE33imGqPgC4kKZIUjgf_up7E-Pj3AaojlMPwNNXaeGA"
        -getUrl(): string: "https://play-lh.googleusercontent.com/z5nin1RdQ4UZhv6fa1FNG7VE33imGqPgC4kKZIUjgf_up7E-Pj3AaojlMPwNNXaeGA"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/z5nin1RdQ4UZhv6fa1FNG7VE33imGqPgC4kKZIUjgf_up7E-Pj3AaojlMPwNNXaeGA=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.53436
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    "com.google.android.apps.youtube.kids" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.google.android.apps.youtube.kids"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.youtube.kids"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.youtube.kids&hl=en_US&gl=us"
      -getName(): string: "YouTube Kids"
      -getSummary(): ?string: "Encourage kids to discover the world with a suite of parental controls"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "5700313618786177705"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=5700313618786177705"
        -getName(): string: "Google LLC"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/S4wylkvt2jz16hnG9IG0pAZosbB82nWWy8P-rQkb54uH-SCVd5L2j7z7x1Vz5pZvIRc"
        -getUrl(): string: "https://play-lh.googleusercontent.com/S4wylkvt2jz16hnG9IG0pAZosbB82nWWy8P-rQkb54uH-SCVd5L2j7z7x1Vz5pZvIRc"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/S4wylkvt2jz16hnG9IG0pAZosbB82nWWy8P-rQkb54uH-SCVd5L2j7z7x1Vz5pZvIRc=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.3300085
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
```

</details>

## See Also
* [Nelexa\GPlay\GPlayApps::UNLIMIT](README.md#predefined-constants) - Limit for all available results.

[Documentation](../../README.md) > [GPlayApps](README.md) > **getListApps**
