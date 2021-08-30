# copycake

<img src="icon.png" alt="drawing" width="200"/>

### About this app

Copy Cake App was created for my girlfriend who is a copywriter. The app allows users to manage their tasks in an easy way.

Copywiters can add all of tasks that have been commissioned by their clients.
The application automatically calculates the price of the task based on the number of characters in each text written by the copywriter.
In addition, the tool generates a simple report for a specific period that can be presented to customers in PDF format.

### Docker

To run app in docker run:

    docker-compose up -d

To get into php container:

    docker exec -it php-fpm /bin/bash

Install all libraries:

    composer install

After install libraries create <b>.env</b> files with config connection     

For testing app in docker run:

    ./vendor/bin/phpunit