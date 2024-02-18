#!/bin/bash -eu

# Start services
service php8.2-fpm restart
service nginx restart
service mysql restart

# Execute
exec /bin/bash
