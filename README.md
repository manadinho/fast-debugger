# fast-debugger

By using `Fast Debugger`, you can expedite the process of troubleshooting Laravel code and resolving issues.
First install `Fast Debugger` desktop application according to your operating system.
Now you are ready to receive log data from `Laravel` projects.

## download desktop application
[mac](https://drive.google.com/file/d/1LKXWI8x8jiLawN5b9qmv_pV3djYsAzh6/view?usp=share_link).
[windows](https://drive.google.com/file/d/1AmpOiaD7kWe1DetkNWuVTE4TNb6647Dq/view?usp=share_link).
[linux](https://drive.google.com/file/d/1zDwRCBDEgDSAYlzS4gD_8o6wKRkfDe4f/view?usp=share_link).


## installation

    composer require manadinho/fast-debugger
    
## Usage

To use `Fast Debugger` in your `Laravel` project.
```php
fast('FAST DEBUGGER IS WORKING');
```

To use `Fast Debugger` from `blade` files.

```php
@fast('FAST DEBUGGER IS WORKING');
```

## Note
* `Fast Debugger` works only in local environment.
* You can also pass multiple arguments.

You can specify flag to identify your specific log by chainig `flag()` method.

```php
fast('FAST DEBUGGER IS WORKING')->flag('FLAG TO IDENTIFY');
```

On log data you can see file name and line number from the `fast()` or `@fast()` method is called. You can open file in `VSCODE` by simply clicking on file name.
