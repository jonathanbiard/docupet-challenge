#!/bin/bash -eu

# Start services
service php8.1-fpm restart
service nginx restart
service mysql restart

# Execute
exec /bin/bash
