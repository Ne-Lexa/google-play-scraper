[Documentation](../../README.md) > [GPlayApps](README.md) > **getSearchSuggestions**

# Nelexa\GPlay\GPlayApps::getSearchSuggestions
`Nelexa\GPlay\GPlayApps::getSearchSuggestions` — Returns the Google Play search suggests.

## Description
```php
Nelexa\GPlay\GPlayApps::getSearchSuggestions ( string $query ) : string[]
```

## Parameters
* **$query** (string)  
search query

## Return Values
array containing search suggestions


## Errors/Exceptions
* Throws [Nelexa\GPlay\Exception\GooglePlayException](../GooglePlayException/README.md) if HTTP error is received
## Examples
```php
$suggestions = $gplay
//    ->setDefaultLocale('en_US') // can set locale
//    ->setDefaultCountry('us')   // can set country
    ->getSearchSuggestions($query = 'Maps')
;
```
<details>
  <summary>Results</summary>

```php
array:5 [
    0 => "maps"
    1 => "maps for minecraft"
    …
  ]
```

</details>

[Documentation](../../README.md) > [GPlayApps](README.md) > **getSearchSuggestions**
