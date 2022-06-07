[Documentation](../../README.md) > [GPlayApps](README.md) > **getClusterPages**

# Nelexa\GPlay\GPlayApps::getClusterPages
`Nelexa\GPlay\GPlayApps::getClusterPages` — Returns an iterator of cluster pages.

## Description
```php
Nelexa\GPlay\GPlayApps::getClusterPages ( [ string | Nelexa\GPlay\Model\Category | Nelexa\GPlay\Enum\CategoryEnum | null $category = null ] [, Nelexa\GPlay\Enum\AgeEnum | null $age = null ] ) : \Generator<Nelexa\GPlay\Model\ClusterPage>
```
[Nelexa\GPlay\Enum\CategoryEnum](../CategoryEnum/README.md) or
`null` for all categories

## Parameters
* **$category** (string | [Nelexa\GPlay\Model\Category](../Category/README.md) | [Nelexa\GPlay\Enum\CategoryEnum](../CategoryEnum/README.md) | null)  
application category as
string, [Nelexa\GPlay\Model\Category](../Category/README.md),
* **$age** ([Nelexa\GPlay\Enum\AgeEnum](../AgeEnum/README.md) | null)  
age limit or `null` for no limit

## Return Values
an iterator of cluster pages


## Errors/Exceptions
* Throws [Nelexa\GPlay\Exception\GooglePlayException](../GooglePlayException/README.md)
## Examples
**Example 1. Fetch all cluster pages**
```php
$clusterPage = 'https://play.google.com/store/apps/collection/cluster?clp=ogooCAEaHAoWcmVjc190b3BpY19vbDFxdl9tODloVRA7GAMqAggBUgIIAg%3D%3D:S:ANO1ljLnmTE&gsr=CiuiCigIARocChZyZWNzX3RvcGljX29sMXF2X204OWhVEDsYAyoCCAFSAggC:S:ANO1ljJBunU';

$clusterPages = iterator_to_array($gplay->getClusterPages());
```
<details>
  <summary>Results</summary>

```php
array:27 [
    0 => class Nelexa\GPlay\Model\ClusterPage {
      -getTitle(): string: "Popular apps"
      -getUrl(): string: "https://play.google.com/store/apps/collection/cluster?gsr=ShwSFwoCCAEQBBoLQVBQTElDQVRJT04qAggB-AEA:S:ANO1ljLOWNs"
    }
    1 => class Nelexa\GPlay\Model\ClusterPage {
      -getTitle(): string: "Low on space?"
      -getUrl(): string: "https://play.google.com/store/apps/collection/cluster?gsr=SmoKZQodChlwcm9tb3Rpb25fMzAwMTg1OF9sb3dfYXBrEAISPgo6bmV3X2hvbWVfZGV2aWNlX2ZlYXR1cmVkX3JlY3My…"
    }
    …
  ]
```

</details>

**Example 1. Fetch all top cluster pages by category "Game Puzzle" for ages up to 5.**
```php
$clusterPage = 'https://play.google.com/store/apps/collection/cluster?clp=ogooCAEaHAoWcmVjc190b3BpY19vbDFxdl9tODloVRA7GAMqAggBUgIIAg%3D%3D:S:ANO1ljLnmTE&gsr=CiuiCigIARocChZyZWNzX3RvcGljX29sMXF2X204OWhVEDsYAyoCCAFSAggC:S:ANO1ljJBunU';

$clusterPages = iterator_to_array(
    $gplay->getClusterPages(
        \Nelexa\GPlay\Enum\CategoryEnum::GAME_PUZZLE(),
        \Nelexa\GPlay\Enum\AgeEnum::FIVE_UNDER(),
        'top'
    )
);
```
<details>
  <summary>Results</summary>

```php
array:20 [
    0 => class Nelexa\GPlay\Model\ClusterPage {
      -getTitle(): string: "Top-rated games"
      -getUrl(): string: "https://play.google.com/store/apps/collection/cluster?clp=ogoXCAkSC0dBTUVfUFVaWkxFKgIIB1ICCAE%3D:S:ANO1ljIIXE4&gsr=ChqiChcICRILR0FNRV9QVVpaTEUqAggHUgI…"
    }
    1 => class Nelexa\GPlay\Model\ClusterPage {
      -getTitle(): string: "Recommended for you"
      -getUrl(): string: "https://play.google.com/store/apps/collection/cluster?clp=ogoXCAESC0dBTUVfUFVaWkxFKgIIB1ICCAE%3D:S:ANO1ljKwRMs&gsr=ChqiChcIARILR0FNRV9QVVpaTEUqAggHUgI…"
    }
    …
  ]
```

</details>

[Documentation](../../README.md) > [GPlayApps](README.md) > **getClusterPages**
