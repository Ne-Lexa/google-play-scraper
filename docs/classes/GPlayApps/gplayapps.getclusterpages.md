[Documentation](../../README.md) > [GPlayApps](README.md) > **getClusterPages**

# Nelexa\GPlay\GPlayApps::getClusterPages
`Nelexa\GPlay\GPlayApps::getClusterPages` — Returns an iterator of cluster pages.

## Description
```php
Nelexa\GPlay\GPlayApps::getClusterPages ( [ string | Nelexa\GPlay\Model\Category | Nelexa\GPlay\Enum\CategoryEnum | null $category = null ] [, Nelexa\GPlay\Enum\AgeEnum | null $age = null ] [, string | null $path = null ] ) : iterable<Nelexa\GPlay\Model\ClusterPage>
```
[Nelexa\GPlay\Enum\CategoryEnum](../CategoryEnum/README.md) or
`null` for all categories

## Parameters
* **$category** (string | [Nelexa\GPlay\Model\Category](../Category/README.md) | [Nelexa\GPlay\Enum\CategoryEnum](../CategoryEnum/README.md) | null)  
application category as
string, [Nelexa\GPlay\Model\Category](../Category/README.md),
* **$age** ([Nelexa\GPlay\Enum\AgeEnum](../AgeEnum/README.md) | null)  
age limit or `null` for no limit
* **$path** (string | null)  
`top`, `new` or `null`

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
array:23 [
    0 => class Nelexa\GPlay\Model\ClusterPage {
      -getTitle(): string: "Recommended for you"
      -getUrl(): string: "https://play.google.com/store/apps/collection/cluster?clp=ogoKCAEqAggBUgIIAQ%3D%3D:S:ANO1ljJG6Aw&gsr=Cg2iCgoIASoCCAFSAggB:S:ANO1ljLKNqE"
    }
    1 => class Nelexa\GPlay\Model\ClusterPage {
      -getTitle(): string: "Entertainment"
      -getUrl(): string: "https://play.google.com/store/apps/collection/cluster?clp=ogooCAEaHAoWcmVjc190b3BpY19tRWdfUlNWMHY2QRA7GAMqAggBUgIIAg%3D%3D:S:ANO1ljKiaBY&gsr=CiuiCigIA…"
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
array:3 [
    0 => class Nelexa\GPlay\Model\ClusterPage {
      -getTitle(): string: "Top free"
      -getUrl(): string: "https://play.google.com/store/apps/collection/cluster?clp=0g4jCiEKG3RvcHNlbGxpbmdfZnJlZV9HQU1FX1BVWlpMRRAHGAM%3D:S:ANO1ljLYuNA&gsr=CibSDiMKIQobdG9wc2V…"
    }
    1 => class Nelexa\GPlay\Model\ClusterPage {
      -getTitle(): string: "Top paid"
      -getUrl(): string: "https://play.google.com/store/apps/collection/cluster?clp=0g4jCiEKG3RvcHNlbGxpbmdfcGFpZF9HQU1FX1BVWlpMRRAHGAM%3D:S:ANO1ljIFZPM&gsr=CibSDiMKIQobdG9wc2V…"
    }
    …
  ]
```

</details>

[Documentation](../../README.md) > [GPlayApps](README.md) > **getClusterPages**
