rabbitmqctl add_user chemiq_rabbit chemiq_rabbit_pass
rabbitmqctl set_user_tags chemiq_rabbit administrator
rabbitmqctl set_permissions -p / chemiq_rabbit ".*" ".*" ".*"