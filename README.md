# DocuPet Full-Stack Coding Challenge
Full-stack developer challenge for DocuPet's hiring process.

## Packages
- `Ubuntu:latest` docker image
- `PHP 8.2` (Installed through PPA with PHP-CLI + PHP-FPM + Composer)
- `Nginx 1.18.0` (using PHP-FPM unix socket)
- `MySQL 8.0.36`
- `Symfony 7.0.3` (with Doctrine)

## Installation
1. Install docker for your operating system [here](https://docs.docker.com/engine/install/)
2. Clone the repository from GitHub in your preferred location
3. Open a terminal inside the root of the cloned repository
4. Build the image by running `docker compose build`
5. Run the container by running `docker compose up -d`
   - If your host ports are occupied by other processes, you may change the first number of each port in the `compose.yaml` file to a free port on the host. For example, using `8080:80` will open up port `8080` on the host and map to port `80` inside the container.
   - If you use a port other than `80` on the host, you will have to access it through `https://localhost:{port}` in the URL
6. Optionally, enter the container by running `docker compose exec docupet /bin/bash`

_Note that the first time the container runs will need to install project dependencies and initial database migration and seeding. Please check the container's output to know when it has completed._

## Project Access

You may load the project at https://localhost.

Note that if you open up a different HTTPS port on the host, it will need to be specified in the URL.

## MySQL Access

MySQL has been set up with user:pass `docupet`:`docupet` and allows external connections so you can connect from the host with your preferred tool, such as the database extension in Jetbrains products or MySQL Workbench.

You may connect to mysql via the host at port `3306` or whichever port you decide to open on the host in the `docker run` command. 

## Other Notes
- A bare Ubuntu image was used in order to showcase that the entire stack was provisioned and configured from scratch, such as Nginx, PHP, MySQL, and the project root. Otherwise, in a business environment, using a ready-made image would be a smarter choice to get a better-tested and freely-evolving image for less development time investment.
- All configuration files related to provisioning are available in the `/docker` directory for inspection.

## Possible Improvements
- Ideally, containers would only have one process running in each and they would be networked and orchestrated with docker-compose. The current solution was encapsulated in a single container as that's what the challenge document seemed to request. The size of the image could be smaller and more performant if optimized images were used.
- A standalone solution such as PhpMyAdmin or Adminer would be good to offer for a no-setup database access for reviewers.
