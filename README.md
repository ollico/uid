# UID Helper

A handy little Laravel compatible package that creates unique identifiers like `u5CVsCnxyXg` for your Eloquent models.

## Installation

Require this package

```
composer require wearealgomas/uid
```

## Usage

### Configuration

Create a new entry in `database.config.php` to configure your uid's:
```
    'uid' => [
        'salt' => '', // Default ''
        'minLength' => '', // Default 0
        'alphabet' => '', // Default 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'
    ],
```
You can remove the `salt`, `minLength` or `alphabet` to use default values.

### Database

Add the `$table->uid()` in your Schemas:

```
Schema::create('your_table', function (Blueprint $table) {
    $table->uid();
})
```

### Eloquent

Add the `HasUid` trait to your `Models` to add the capabilities:

* Local scope `$model->uid($uid)`
* Automatic generation of `uid` during the `creating` event

## Good to know

We utilise [HashIds](https://github.com/ivanakimov/hashids.php) under the hood.
