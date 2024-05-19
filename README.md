
## Generate Hash Password 
```js
var salt = "RANDOMME";
sha256("1:1234").then(hashLv1 => {   
    console.log(hashLv1);
	sha256(hashLv1+":"+salt).then(hashLv2 => {
        console.log(hashLv2);
    });
});
```


### Artisan Command

run appserv 
```php artisan serve```

generate model with migration
```php artisan make:model user_account -a```

maintenance mode
```php artisan down```
```php artisan up```

### SCSS Watch

```npm run scss```
