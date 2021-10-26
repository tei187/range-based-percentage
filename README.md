# RangeBasedPercentage
---

RangeBasedPercentage is a utility helping to calculate the percentage of a number in given range.
Examples:
- for a range of 2-6, 4 is 50%
- for a range of 20-40, 25 is 25%
- for a range of 31-152, 63 is 26.446280991736%
- and so on...

## How to use?
### Standard
```php
$calculator = new tei187\Utilities\RangeBasedPercentage(5, 29);  // initiate object with range 5-29
echo $calculator->getPercentage(18); // get for 18, echoes "54.166666666667"
```

### Method chaining
```php
$calculator = new tei187\Utilities\RangeBasedPercentage;  // initiate object

echo $calculator->setRange(5, 29)->getPercentage(18); // echoes "54.166666666667"
echo $calculator->setRange(5, 11)->getPercentage(9); // echoes "66.666666666667"
```

## Requirements
- PHP >= 7.3

## Author
- [tei187](mailto:bonk.piotr@gmail.com)
