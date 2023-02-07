Command to update exisiting table's column with migration without losing data:

1. php artisan make:migration add_mobile_no_to_users_table --table=add_mobile_no_to_users_table

2. after using the command above, we can find the new migration file in database/migrations/yyyy_mm_dd_add_mobile_no_to_users_table.php

3. add desire field to the migration file

4. $table->string('mobile_no')->nullable()->after('username');
or $table->boolean('status')->default('1');

add change() if modifying existing column

$table->boolean('status')->default('1')->change();
or $table->string('name', 50)->change();

# check here for more info https://laravel.com/docs/5.6/migrations

5. php artisan migrate