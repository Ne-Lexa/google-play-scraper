[Documentation](../../README.md) > [AgeEnum](README.md) > **values**

# Nelexa\GPlay\Enum\AgeEnum::values
`Nelexa\GPlay\Enum\AgeEnum::values` — Returns an array containing the constants of this enum type, in the order they're declared.

## Description
```php
Nelexa\GPlay\Enum\AgeEnum::values ( void ) : static[]
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
    0 => class Nelexa\GPlay\Enum\AgeEnum {
      -name(): string: "FIVE_UNDER"
      -value(): mixed: "AGE_RANGE1"
      -ordinal(): int: 0
      -__toString(): string: "AGE_RANGE1"
    }
    1 => class Nelexa\GPlay\Enum\AgeEnum {
      -name(): string: "SIX_EIGHT"
      -value(): mixed: "AGE_RANGE2"
      -ordinal(): int: 1
      -__toString(): string: "AGE_RANGE2"
    }
    …
  ]
```

[Documentation](../../README.md) > [AgeEnum](README.md) > **values**
