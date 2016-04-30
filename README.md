# OneSky Android flavour strings sync

## Install

```
composer install
```

## Compile

You need Box project : http://box-project.github.io/box2/
In the project directory run :

```
box build
```

Remember to git tag before.

## Settings file

Create a file named ".onesky.strings.yml" :

```
id: 123
strings:
    - path: "/somewhere/strings.xml"
      locale: "en_US"        
```

The path can be a folder

## Credentials file

Create a file named ".onesky.secret.yml" :

```
api_key: 123
api_secret: 456
       
```


## Tests

```
vendor/phpunit/phpunit/phpunit
```
