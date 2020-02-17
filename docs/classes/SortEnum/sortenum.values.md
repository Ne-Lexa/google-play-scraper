[Documentation](../../README.md) > [SortEnum](README.md) > **values**

# Nelexa\GPlay\Enum\SortEnum::values
`Nelexa\GPlay\Enum\SortEnum::values` — Returns an array containing the constants of this enum type, in the order they're declared.

## Description
```php
Nelexa\GPlay\Enum\SortEnum::values ( void ) : static[]
```
This method may be used to iterate over the constants as follows:

```php
foreach(EnumClass::values() as $enum) {
echo $enum->name() . ' => ' . $enum->value() . PHP_EOL;
}
```

## Parameters
This function has no parameters.

## Return Values
An array of constants of this type enum in the order they are declared.

## Sample object content
```php
array:3 [
    0 => class Nelexa\GPlay\Enum\SortEnum {
      -name(): string: "HELPFULNESS"
      -value(): mixed: 1
      -ordinal(): int: 0
      -__toString(): string: "1"
    }
    1 => class Nelexa\GPlay\Enum\SortEnum {
      -name(): string: "NEWEST"
      -value(): mixed: 2
      -ordinal(): int: 1
      -__toString(): string: "2"
    }
    …
  ]
```

[Documentation](../../README.md) > [SortEnum](README.md) > **values**
