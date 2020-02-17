[Documentation](../../README.md) > **PriceEnum**

# The `Nelexa\GPlay\Enum\PriceEnum` class

## Introduction
Contains all valid values for the "price" parameter.

## Class synopsis
```php
Nelexa\GPlay\Enum\PriceEnum extends Nelexa\Enum {

    /* Methods */
    public static ALL ( void ) : Nelexa\GPlay\Enum\PriceEnum
    public static FREE ( void ) : Nelexa\GPlay\Enum\PriceEnum
    public static PAID ( void ) : Nelexa\GPlay\Enum\PriceEnum
    final public static valueOf ( string $name ) : static
    final public name ( void ) : string
    final public value ( void ) : string | int | float | bool | array | null
    final public static values ( void ) : static[]
    final public static containsKey ( string $name ) : bool
    final public static containsValue ( string | int | float | bool | array | null $value [, bool $strict = true ] ) : bool
    final public static fromValue ( string | int | float | bool | array | null $value ) : static
    final public ordinal ( void ) : int
    public __toString ( void ) : string
}
```

## Table of Contents
* [Nelexa\GPlay\Enum\PriceEnum::ALL](priceenum.all.md) - Returns the value of the price parameter for all apps.
* [Nelexa\GPlay\Enum\PriceEnum::FREE](priceenum.free.md) - Returns the value of the price parameter for free apps.
* [Nelexa\GPlay\Enum\PriceEnum::PAID](priceenum.paid.md) - Returns the value of the price parameter for paid apps.
* [Nelexa\GPlay\Enum\PriceEnum::valueOf](priceenum.valueof.md) - Returns the enum of the specified constant name.
* [Nelexa\GPlay\Enum\PriceEnum::name](priceenum.name.md) - Returns the name of this enum constant.
* [Nelexa\GPlay\Enum\PriceEnum::value](priceenum.value.md) - Returns the scalar value of this enum constant.
* [Nelexa\GPlay\Enum\PriceEnum::values](priceenum.values.md) - Returns an array containing the constants of this enum type, in the order they're declared.
* [Nelexa\GPlay\Enum\PriceEnum::containsKey](priceenum.containskey.md) - Checks whether the constant name is present in the enum.
* [Nelexa\GPlay\Enum\PriceEnum::containsValue](priceenum.containsvalue.md) - Checks if enum contains a passed value.
* [Nelexa\GPlay\Enum\PriceEnum::fromValue](priceenum.fromvalue.md) - Returns first enum of the specified constant value.
* [Nelexa\GPlay\Enum\PriceEnum::ordinal](priceenum.ordinal.md) - Returns the ordinal of this enum constant.
* [Nelexa\GPlay\Enum\PriceEnum::__toString](priceenum.tostring.md) - Returns the value of this enum constant, as contained in the declaration.


## Sample object content
```php
class Nelexa\GPlay\Enum\PriceEnum {
  -name(): string: "ALL"
  -value(): mixed: 0
  -ordinal(): int: 0
  -__toString(): string: "0"
}
```

[Documentation](../../README.md) > **PriceEnum**
