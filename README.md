# UID Helper

A handy little Laravel compatible package that creates unique identifiers like `u5CVsCnxyXg` for your Eloquent models.

## Installation

Require this package

```
composer require ollico/uid
```

## Usage

### Configuration


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
