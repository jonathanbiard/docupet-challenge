#!/bin/bash -eu

# Start services
service php8.2-fpm restart
service nginx restart
service mysql restart

# Move to app directory to set up the project dependencies
cd /app

# Download and install the dependencies for the project
composer install
npm install

# Execute the Doctrine database migrations (with initial seeding included)
bin/console --no-interaction doctrine:migration:migrate

# Start the symfony and webpack servers
symfony serve -d

# Echo the completion of the start script
echo
echo "The container is now ready to use!"
echo

# Execute
exec /bin/bash
