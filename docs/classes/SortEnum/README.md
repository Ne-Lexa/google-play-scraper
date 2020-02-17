[Documentation](../../README.md) > **SortEnum**

# The `Nelexa\GPlay\Enum\SortEnum` class

## Introduction
Contains all valid values for the "sort" parameter.

## Class synopsis
```php
Nelexa\GPlay\Enum\SortEnum extends Nelexa\Enum {

    /* Methods */
    public static HELPFULNESS ( void ) : Nelexa\GPlay\Enum\SortEnum
    public static NEWEST ( void ) : Nelexa\GPlay\Enum\SortEnum
    public static RATING ( void ) : Nelexa\GPlay\Enum\SortEnum
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
* [Nelexa\GPlay\Enum\SortEnum::HELPFULNESS](sortenum.helpfulness.md) - Returns the value of the sorting of reviews by helpfulness.
* [Nelexa\GPlay\Enum\SortEnum::NEWEST](sortenum.newest.md) - Returns the value of the sorting of reviews by newest.
* [Nelexa\GPlay\Enum\SortEnum::RATING](sortenum.rating.md) - Returns the value of the sorting of reviews by rating.
* [Nelexa\GPlay\Enum\SortEnum::valueOf](sortenum.valueof.md) - Returns the enum of the specified constant name.
* [Nelexa\GPlay\Enum\SortEnum::name](sortenum.name.md) - Returns the name of this enum constant.
* [Nelexa\GPlay\Enum\SortEnum::value](sortenum.value.md) - Returns the scalar value of this enum constant.
* [Nelexa\GPlay\Enum\SortEnum::values](sortenum.values.md) - Returns an array containing the constants of this enum type, in the order they're declared.
* [Nelexa\GPlay\Enum\SortEnum::containsKey](sortenum.containskey.md) - Checks whether the constant name is present in the enum.
* [Nelexa\GPlay\Enum\SortEnum::containsValue](sortenum.containsvalue.md) - Checks if enum contains a passed value.
* [Nelexa\GPlay\Enum\SortEnum::fromValue](sortenum.fromvalue.md) - Returns first enum of the specified constant value.
* [Nelexa\GPlay\Enum\SortEnum::ordinal](sortenum.ordinal.md) - Returns the ordinal of this enum constant.
* [Nelexa\GPlay\Enum\SortEnum::__toString](sortenum.tostring.md) - Returns the value of this enum constant, as contained in the declaration.


## Sample object content
```php
class Nelexa\GPlay\Enum\SortEnum {
  -name(): string: "RATING"
  -value(): mixed: 3
  -ordinal(): int: 2
  -__toString(): string: "3"
}
```

[Documentation](../../README.md) > **SortEnum**
