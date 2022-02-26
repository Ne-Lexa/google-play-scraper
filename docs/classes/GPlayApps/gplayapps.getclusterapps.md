[Documentation](../../README.md) > [GPlayApps](README.md) > **getClusterApps**

# Nelexa\GPlay\GPlayApps::getClusterApps
`Nelexa\GPlay\GPlayApps::getClusterApps` — Returns an iterator of applications from the Google Play store for the specified cluster page.

## Description
```php
Nelexa\GPlay\GPlayApps::getClusterApps ( string $clusterPageUrl ) : \Generator<Nelexa\GPlay\Model\App>
```

## Parameters
* **$clusterPageUrl** (string)  
cluster page url

## Return Values
an iterator with basic information about applications


## Errors/Exceptions
* Throws [Nelexa\GPlay\Exception\GooglePlayException](../GooglePlayException/README.md)
## Examples
**Example 1. Fetch all apps by cluster page**
```php
$clusterPage = 'https://play.google.com/store/apps/collection/cluster?clp=ogooCAEaHAoWcmVjc190b3BpY19vbDFxdl9tODloVRA7GAMqAggBUgIIAg%3D%3D:S:ANO1ljLnmTE&gsr=CiuiCigIARocChZyZWNzX3RvcGljX29sMXF2X204OWhVEDsYAyoCCAFSAggC:S:ANO1ljJBunU';

$apps = iterator_to_array($gplay->getClusterApps($clusterPage));
```
<details>
  <summary>Results</summary>

```php
array:170 [
    0 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.netflix.mediaclient"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.netflix.mediaclient"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.netflix.mediaclient&hl=en_US&gl=us"
      -getName(): string: "Netflix"
      -getSummary(): ?string: "Netflix is the leading subscription service for watching TV episodes and movies."
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "Netflix, Inc."
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=Netflix,+Inc."
        -getName(): string: "Netflix, Inc."
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
        -__toString(): string: "https://play-lh.googleusercontent.com/TBRwjS_qfJCSj1m7zZB93FnpJM5fSpMA_wUlFDLxWAb45T9RmwBvQd5cWR5viJJOhkI"
        -getUrl(): string: "https://play-lh.googleusercontent.com/TBRwjS_qfJCSj1m7zZB93FnpJM5fSpMA_wUlFDLxWAb45T9RmwBvQd5cWR5viJJOhkI"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/TBRwjS_qfJCSj1m7zZB93FnpJM5fSpMA_wUlFDLxWAb45T9RmwBvQd5cWR5viJJOhkI=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.4724298
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.t11.skyviewfree"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.t11.skyviewfree"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.t11.skyviewfree&hl=en_US&gl=us"
      -getName(): string: "SkyView® Lite"
      -getSummary(): ?string: "SkyView®, an augmented reality space app, brings stargazing to everyone!"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "Terminal Eleven"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=Terminal+Eleven"
        -getName(): string: "Terminal Eleven"
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
        -__toString(): string: "https://play-lh.googleusercontent.com/PpPV2Ug-Cr05xLKQdZJoA9quSanR3Y6L1TtL80ppJgIpRkIU6v_H0UJoDR4VCE4m38RQ"
        -getUrl(): string: "https://play-lh.googleusercontent.com/PpPV2Ug-Cr05xLKQdZJoA9quSanR3Y6L1TtL80ppJgIpRkIU6v_H0UJoDR4VCE4m38RQ"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/PpPV2Ug-Cr05xLKQdZJoA9quSanR3Y6L1TtL80ppJgIpRkIU6v_H0UJoDR4VCE4m38RQ=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.388937
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
```

</details>

**Example 2. Fetch first 10 apps from cluster page url.**
```php
$clusterPage = 'https://play.google.com/store/apps/collection/cluster?clp=ogooCAEaHAoWcmVjc190b3BpY19pREdaa09EdG1UMBA7GAMqAggBUgIIAg%3D%3D:S:ANO1ljKeniA&gsr=CiuiCigIARocChZyZWNzX3RvcGljX2lER1prT0R0bVQwEDsYAyoCCAFSAggC:S:ANO1ljKPzfI&hl=ru';

$limit = 10;
$apps = [];
foreach ($gplay->getClusterApps($clusterPage) as $i => $app) {
    $apps[] = $app;
    if ($i > $limit) {
        break;
    }
}
```
<details>
  <summary>Results</summary>

```php
array:12 [
    0 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.chickfila.cfaflagship"
      -getLocale(): string: "ru_RU"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.chickfila.cfaflagship"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.chickfila.cfaflagship&hl=ru_RU&gl=us"
      -getName(): string: "Chick-fil-A®"
      -getSummary(): ?string: "Заказывайте заранее, получайте баллы за соответствующую покупку и используйте доступные награды."
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "Chick-fil-A, Inc."
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=Chick-fil-A,+Inc."
        -getName(): string: "Chick-fil-A, Inc."
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
        -__toString(): string: "https://play-lh.googleusercontent.com/yF2S41QGnGWs7JCD-t6L6AJ4KIm2ybwM0lirAiHQZR2ZKjbvYAgQ4e0MFVXYVLQWWA"
        -getUrl(): string: "https://play-lh.googleusercontent.com/yF2S41QGnGWs7JCD-t6L6AJ4KIm2ybwM0lirAiHQZR2ZKjbvYAgQ4e0MFVXYVLQWWA"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/yF2S41QGnGWs7JCD-t6L6AJ4KIm2ybwM0lirAiHQZR2ZKjbvYAgQ4e0MFVXYVLQWWA=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.693777
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.chuckecheese.app"
      -getLocale(): string: "ru_RU"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.chuckecheese.app"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.chuckecheese.app&hl=ru_RU&gl=us"
      -getName(): string: "Chuck E. Cheese"
      -getSummary(): ?string: "Зарабатывайте бонусные баллы за каждое посещение и открывайте эксклюзивные предложения!"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "8581794605065481540"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=8581794605065481540"
        -getName(): string: "Chuck E. Cheese"
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
        -__toString(): string: "https://play-lh.googleusercontent.com/xCVK5YbFjD8obUoUuje3ZK-lhFG8XWWpZJKN1B8DUOPS8chirXl6KbP6pMNbjMcDOw"
        -getUrl(): string: "https://play-lh.googleusercontent.com/xCVK5YbFjD8obUoUuje3ZK-lhFG8XWWpZJKN1B8DUOPS8chirXl6KbP6pMNbjMcDOw"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/xCVK5YbFjD8obUoUuje3ZK-lhFG8XWWpZJKN1B8DUOPS8chirXl6KbP6pMNbjMcDOw=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.6525
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
```

</details>

[Documentation](../../README.md) > [GPlayApps](README.md) > **getClusterApps**
