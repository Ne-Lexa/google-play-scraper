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
array:203 [
    0 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.netflix.mediaclient"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.netflix.mediaclient"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.netflix.mediaclient&hl=en_US&gl=us"
      -getName(): string: "Netflix"
      -getDescription(): string: """
        Looking for the most talked about TV shows and movies from the around the world? They’re all on Netflix.\n
        \n
        We’ve got award-winning series, movies, docu…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "Netflix, Inc."
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/TBRwjS_qfJCSj1m7zZB93FnpJM5fSpMA_wUlFDLxWAb45T9RmwBvQd5cWR5viJJOhkI"
        -getUrl(): string: "https://play-lh.googleusercontent.com/TBRwjS_qfJCSj1m7zZB93FnpJM5fSpMA_wUlFDLxWAb45T9RmwBvQd5cWR5viJJOhkI"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/TBRwjS_qfJCSj1m7zZB93FnpJM5fSpMA_wUlFDLxWAb45T9RmwBvQd5cWR5viJJOhkI=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:24 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/m7mg_DZ1uTb6jfGewOOtZ4ejmDaBYfEWZVfEP0pkSX60OsoG7YDgjuFLPCCc6rBnYJk"
          -getUrl(): string: "https://play-lh.googleusercontent.com/m7mg_DZ1uTb6jfGewOOtZ4ejmDaBYfEWZVfEP0pkSX60OsoG7YDgjuFLPCCc6rBnYJk"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/m7mg_DZ1uTb6jfGewOOtZ4ejmDaBYfEWZVfEP0pkSX60OsoG7YDgjuFLPCCc6rBnYJk=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/K4-4tkQJD0U0H_FiAn5yHz_-9Y8bP6f1tGCmFtYwBzn-5Gk1AM8Ga4S3c0T6s4ex_HI"
          -getUrl(): string: "https://play-lh.googleusercontent.com/K4-4tkQJD0U0H_FiAn5yHz_-9Y8bP6f1tGCmFtYwBzn-5Gk1AM8Ga4S3c0T6s4ex_HI"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/K4-4tkQJD0U0H_FiAn5yHz_-9Y8bP6f1tGCmFtYwBzn-5Gk1AM8Ga4S3c0T6s4ex_HI=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.4518275
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "1,000,000,000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.microsoft.office.officehubrow"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.microsoft.office.officehubrow"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.microsoft.office.officehubrow&hl=en_US&gl=us"
      -getName(): string: "Microsoft Office: Edit & Share"
      -getDescription(): string: """
        Microsoft Office brings you Word, Excel, and PowerPoint all in one app. Take advantage of a seamless experience with Microsoft tools on the go with th…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "Microsoft Corporation"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/D6XDCje7pB0nNP1sOZkwD-tXkV0_As3ni21us5yZ71_sy0FTWv1s_MQBe1JUnHlgE94"
        -getUrl(): string: "https://play-lh.googleusercontent.com/D6XDCje7pB0nNP1sOZkwD-tXkV0_As3ni21us5yZ71_sy0FTWv1s_MQBe1JUnHlgE94"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/D6XDCje7pB0nNP1sOZkwD-tXkV0_As3ni21us5yZ71_sy0FTWv1s_MQBe1JUnHlgE94=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:8 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/cDvFQbu-3O3NfyrNSkx9d1Ua25bYS3Ly8fCcPgdMnj5ktHh0uidRp0OiNVIb5OFB5ck"
          -getUrl(): string: "https://play-lh.googleusercontent.com/cDvFQbu-3O3NfyrNSkx9d1Ua25bYS3Ly8fCcPgdMnj5ktHh0uidRp0OiNVIb5OFB5ck"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/cDvFQbu-3O3NfyrNSkx9d1Ua25bYS3Ly8fCcPgdMnj5ktHh0uidRp0OiNVIb5OFB5ck=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/h054Q_gu6miJlzLA59fyO6sgtSFlEVIa1iSgHeqUXik07F2-ppZNPUK8XjLdnIVI0PA"
          -getUrl(): string: "https://play-lh.googleusercontent.com/h054Q_gu6miJlzLA59fyO6sgtSFlEVIa1iSgHeqUXik07F2-ppZNPUK8XjLdnIVI0PA"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/h054Q_gu6miJlzLA59fyO6sgtSFlEVIa1iSgHeqUXik07F2-ppZNPUK8XjLdnIVI0PA=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.5317974
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "500,000,000+"
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
      -getId(): string: "com.propel.ebenefits"
      -getLocale(): string: "ru_RU"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.propel.ebenefits"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.propel.ebenefits&hl=ru_RU&gl=us"
      -getName(): string: "Providers: EBT, debit, & more"
      -getDescription(): string: """
        Providers (formerly Fresh EBT) is the #1 rated EBT app  for checking your food stamp balance. Plus, you can now manage other benefits and income with …
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "Propel Inc"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/KZZXWqhPRrC90BMBPYDErwovMvxHgmp9Oq3kWOBPgMl0ySoQktr9sQ1ItEKWtGr_VcJE"
        -getUrl(): string: "https://play-lh.googleusercontent.com/KZZXWqhPRrC90BMBPYDErwovMvxHgmp9Oq3kWOBPgMl0ySoQktr9sQ1ItEKWtGr_VcJE"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/KZZXWqhPRrC90BMBPYDErwovMvxHgmp9Oq3kWOBPgMl0ySoQktr9sQ1ItEKWtGr_VcJE=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:8 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/8s0av_Mi4dWXeR1LQaEVk4MtpjDpGqb-uOc7C2IcNqTaQffa_XwYDqsF8zxTDjBi4LOJ"
          -getUrl(): string: "https://play-lh.googleusercontent.com/8s0av_Mi4dWXeR1LQaEVk4MtpjDpGqb-uOc7C2IcNqTaQffa_XwYDqsF8zxTDjBi4LOJ"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/8s0av_Mi4dWXeR1LQaEVk4MtpjDpGqb-uOc7C2IcNqTaQffa_XwYDqsF8zxTDjBi4LOJ=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/xkw61UodnuL9G6tjyLlLbRUgWWbrDrjBduAV8LmGhImSDnIkMXGGiKZaOPmNVSZI0ds"
          -getUrl(): string: "https://play-lh.googleusercontent.com/xkw61UodnuL9G6tjyLlLbRUgWWbrDrjBduAV8LmGhImSDnIkMXGGiKZaOPmNVSZI0ds"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/xkw61UodnuL9G6tjyLlLbRUgWWbrDrjBduAV8LmGhImSDnIkMXGGiKZaOPmNVSZI0ds=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.7484856
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "10 000 000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.tacobell.ordering"
      -getLocale(): string: "ru_RU"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.tacobell.ordering"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.tacobell.ordering&hl=ru_RU&gl=us"
      -getName(): string: "Taco Bell – Order Fast Food"
      -getDescription(): string: """
        With the Taco Bell App, you can order and pay ahead, skip our line, get access to new deals and offers, and more.\n
        \n
        App Features include:\n
        \n
        REDEEM REWAR…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "Taco Bell Mobile"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/wWXePJtJwa8slrpch_scAqld5hNDAQKx-KSLDo5uo69yfQv-_k6o5OPPjEQrdRHFHOo"
        -getUrl(): string: "https://play-lh.googleusercontent.com/wWXePJtJwa8slrpch_scAqld5hNDAQKx-KSLDo5uo69yfQv-_k6o5OPPjEQrdRHFHOo"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/wWXePJtJwa8slrpch_scAqld5hNDAQKx-KSLDo5uo69yfQv-_k6o5OPPjEQrdRHFHOo=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:6 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/Jk2tFc36FvYTpisapcpQzMuReYHaxvua5wetPgD6oE4tXgPTQZS-Ii39mcUTW9XbIs6Y"
          -getUrl(): string: "https://play-lh.googleusercontent.com/Jk2tFc36FvYTpisapcpQzMuReYHaxvua5wetPgD6oE4tXgPTQZS-Ii39mcUTW9XbIs6Y"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/Jk2tFc36FvYTpisapcpQzMuReYHaxvua5wetPgD6oE4tXgPTQZS-Ii39mcUTW9XbIs6Y=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/vvh-ryJMzMcFDGDEdfv92jiWjAn-Gw7B5nFLA314RKMG-sp82TQEJEzciOHX_F8zFko"
          -getUrl(): string: "https://play-lh.googleusercontent.com/vvh-ryJMzMcFDGDEdfv92jiWjAn-Gw7B5nFLA314RKMG-sp82TQEJEzciOHX_F8zFko"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/vvh-ryJMzMcFDGDEdfv92jiWjAn-Gw7B5nFLA314RKMG-sp82TQEJEzciOHX_F8zFko=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.1398363
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "10 000 000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
```

</details>

[Documentation](../../README.md) > [GPlayApps](README.md) > **getClusterApps**
