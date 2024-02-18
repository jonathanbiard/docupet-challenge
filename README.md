# DocuPet Full-Stack Coding Challenge
Full-stack developer challenge for DocuPet's hiring process.

## Packages
- `Ubuntu:latest` docker image
- `PHP 8.2` (Installed through PPA with PHP-CLI + PHP-FPM + Composer)
- `Nginx 1.18.0` (using PHP-FPM unix socket)
- `MySQL 8.0.36` (DocuPet's preferred relational database)
- `Symfony 7.0.3` (with Doctrine)
- `NodeJS 21.6.2` (with NPM 10.2.4 for WebpackEncore support)
- `VueJS 3.4.19`
- `Sass 1.71.0`
- `Bootstrap 5.3.2`

## Installation
1. Install docker for your operating system [here](https://docs.docker.com/engine/install/)
2. Clone the repository from GitHub in your preferred location
3. Open a terminal inside the root of the cloned repository
4. Build the image by running `docker compose build`
5. Run the container by running `docker compose up -d`
   - _Note that the first time the container runs will need to install project dependencies and initial database migration and seeding. Please check the container's output to know when it has completed. You will be greeted with a message that says `The container is now ready to use!`._
6. Enter the container by running `docker compose exec docupet /bin/bash` and run your preferred build from the `/app` directory:
   - (Dev) Watch and recompile when changes are detected: `npm run watch`
   - (Dev) Compile once as a development build: `npm run dev`
   - (Prod) Compile once as a production build: `npm run build`
   - _Note that these are not started automatically with the container in order to retain full control of the build types and daemons._
7. See "Project Access" below.


## Project Access

You may now load the project through the Symfony web server at:

https://localhost:8000

Alternatively, you may also load the project through the Nginx+PHP-FPM web server configuration at:

https://localhost

_Note that SSL through HTTPS is voluntarily forced with either web server and you may need to allow the self-signed certificates from your browser._

## MySQL Access

MySQL has been set up with user:pass `docupet`:`docupet` and allows external connections so you can connect from the host with your preferred tool, such as the database extension in Jetbrains products or MySQL Workbench.

You may connect to mysql via the host at port `3306` or whichever port you decide to open on the host in the `docker run` command. 

## Other Notes
- A bare Ubuntu image was used in order to showcase that the entire stack was provisioned and configured from scratch, such as Nginx, PHP, MySQL, and the project root. Otherwise, in a business environment, using a ready-made image would be a smarter choice to get a better-tested and freely-evolving image for less development time investment.
- All configuration files related to provisioning are available in the `/docker` directory for inspection.

## Possible Improvements
- Ideally, containers would only have one process running in each and they would be networked and orchestrated with docker-compose. The current solution was encapsulated in a single container as that's what the challenge document seemed to request. The size of the image could be smaller and more performant if optimized images were used.
- A standalone solution such as PhpMyAdmin or Adminer would be good to offer for a no-setup database access for reviewers.
- Using Typescript instead of plain Javascript to gain strong typing and catch errors during the build rather than at runtime.
