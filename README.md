SimpleDbWrapper
===============

*SimpleDbWrapper* is a very simple DB wrapper I wrote to practice my PHPUnit :). It sits somewhere between plain SQL and
robust, fully fledged ORMs. Locked to MySQL and later in memory (for testing purposes).

*SimpleDbWrapper* has a nice unwrapping functionality, so your domain object, simple value objects, presenters or DTOs
are easily hydrated straight from the returned result set.

Still very much a toy and work in progress at this stage. Please, don't consider for commercial projects.

Examples
--------

```php
<?php

$db = new SimpleDbWrapper($config);

$resultSet = $db->selectAllFrom('users');
$tuple = $resultSet[0]; // array access
$user = $resultSet[0]->andReturnAs(User::class);
$users = $resultSet->andReturnAs('array[User]');
$users = $resultSet->andReturnAs(Users::class);

$attribute = $db->selectIdFrom('users');
$id = $attribute->asInt(); // as value: $attribute->andReturnAs(UserUuid::class);

$tuple = $db->findUnique('users', ['id' => 1]);
$user = $tuple->andReturnAs(User::class);

$attribute = $db->insertInto('users', User::named('William'));
$attribute->andReturnAs(UserUuid::class);

$attribute = $db->insertInto('users', ['name' => 'William']);
$uuid = $attribute->asInt();
$this->insertInto('users', 'William');

$count = $db->update('users', 1, ['name' => 'John']);
$count = $db->update('users', ['name' => 'John']);

$db->flush();
```