### Debug messenger of rabbitmq

    php bin/console messenger:failed:show

### Run messenger

     php bin/console messenger:consume -vv

### Migration database

synchronize doctrine with actual database

    php bin/console doctrine:migrations:sync-metadata-storage

generate sql to execute on database

    php bin/console doctrine:migrations:diff

start execute query in database

    php bin/console doctrine:migrations:migrate     //  php bin/console doctrine:migrations:migrate 'DoctrineMigrations\Version20180605025653'

to checking the status of migration sql

     php bin/console doctrine:migrations:status
