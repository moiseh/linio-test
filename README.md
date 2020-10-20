# Linio Test Challenge

## Steps to execute

### 1. Update composer packages

```bash
composer update
```

### 2. Execute the PHP Challenger script

```bash
php challenger.php
```

### 3. Execute the PHPUnit test cases

```bash
phpunit --bootstrap vendor/autoload.php tests
```

## Challenge - Backend Developer
Write a program that prints all the numbers from 1 to 100. However, for
multiples of 3, instead of the number, print "Linio". For multiples of 5 print
"IT". For numbers which are multiples of both 3 and 5, print "Linianos".

But here's the catch: you can use only one `if`. No multiple branches, ternary
operators or `else`.

# Requirements
* 1 if
* You can't use `else`, `else if` or ternary
* Unit tests
* Feel free to apply your SOLID knowledge
* You can write the challenge in any language you want. Here at Linio we are big fans of PHP, Kotlin and TypeScript

# Submission
You can create a public repository on your GitHub account and send the
link to us, or just send us a zip file.
