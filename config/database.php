<?php

// 1 jika dihosting
$konektor=1;
if($konektor==1){
  $url = parse_url(getenv("DATABASE_URL"));

  $host = "ec2-54-225-76-201.compute-1.amazonaws.com";
  $username = "qjvzwvluowbszj";
  $password = "5a10879b8edd4c517cc733a923f1d3214d69d4dcba39e8a8ed7ec8bc53b949b5";
  $database = "db5hg940121km3";

  return [
      'default' => env('DB_CONNECTION', 'pgsql'),
      'connections' => [

          'pgsql' => [
          'driver'   => 'pgsql',
          'host'     => $host,
          'database' => $database,
          'username' => $username,
          'password' => $password,
          'charset'  => 'utf8',
          'prefix'   => '',
          'schema'   => 'public',
      ],
    ],
      'migrations' => 'migrations',
      'redis' => [

          'client' => 'predis',

          'default' => [
              'host' => env('REDIS_HOST', '127.0.0.1'),
              'password' => env('REDIS_PASSWORD', null),
              'port' => env('REDIS_PORT', 6379),
              'database' => 0,
          ],

      ],

  ];
}else{
  return [
      'default' => env('DB_CONNECTION', 'mysql'),
      'connections' => [

          'sqlite' => [
              'driver' => 'sqlite',
              'database' => env('DB_DATABASE', database_path('database.sqlite')),
              'prefix' => '',
          ],

          'mysql' => [
              'driver' => 'mysql',
              'host' => env('DB_HOST', '127.0.0.1'),
              'port' => env('DB_PORT', '3306'),
              'database' => env('DB_DATABASE', 'forge'),
              'username' => env('DB_USERNAME', 'forge'),
              'password' => env('DB_PASSWORD', ''),
              'unix_socket' => env('DB_SOCKET', ''),
              'charset' => 'utf8mb4',
              'collation' => 'utf8mb4_unicode_ci',
              'prefix' => '',
              'strict' => true,
              'engine' => null,
          ],
      ],

      'migrations' => 'migrations',
      'redis' => [

          'client' => 'predis',

          'default' => [
              'host' => env('REDIS_HOST', '127.0.0.1'),
              'password' => env('REDIS_PASSWORD', null),
              'port' => env('REDIS_PORT', 6379),
              'database' => 0,
          ],
      ],
  ];
}
