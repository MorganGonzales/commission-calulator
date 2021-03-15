# Morgy's Commission Calculator
An create an application that handles operations provided in CSV format and calculates a commission fee based on defined rules. 

## Installation
To install, you simply clone this repository:

```shell
$ git clone https://github.com/MorganGonzales/commission-calulator.git
```

Inside the root directory of the project, install its dependencies using [Composer](https://getcomposer.org/).

```shell
$ composer install
```

## Usage
### Running The Application
Assuming you already have PHP installed, simply run the command below:

```shell
$ php script.php input.csv
```

> **Note:** This application was developed using PHP 7.4, some features such as `Property Type Hints` may not work on lower versions.

### Testing The Application
Unit test are executed by entering the command below:

```shell
$ composer run tests
```

## Limitations | Points for Improvement
- Loading of the CSV file is pretty straightforward. Validation for the entered file has not been implemented.
- Mapping validation of data from CSV file can be implemented on the `Operation` value object
