# DocuPet Full-Stack Coding Challenge
Full-stack developer challenge for DocuPet's hiring process.

## Packages
- `Ubuntu:latest` docker image
- `PHP 8.1` (PHP-CLI + PHP-FPM + Composer)
- `Nginx 1.18.0` (using PHP-FPM unix socket)
- `MySQL 8.0.36`

## Installation
1. Install docker for your operating system [here](https://docs.docker.com/engine/install/)
2. Clone the repository from GitHub in your preferred location
3. Open a terminal inside the root of the cloned repository
4. Build the image by running `docker build -t jonbiard/docupet:latest .`
5. Run the container by running `docker run -d --name="docupet" -p 80:80 -p 443:443 -p 3306:3306 -t jonbiard/docupet:latest`
   - If your host ports are occupied by other processes, you may change the first number of each `-p` argument to a free port on the host. For example, using `-p 8080:80` will open up port `8080` on the host and map to port `80` inside the container.
   - If you use a port other than `80` on the host, you will have to access it through `https://localhost:{port}` in the URL
6. Optionally, enter the container by running `docker exec -it docupet /bin/bash`

## Project Access

You may load the project at https://localhost. Note that if you open up a different HTTPS port on the host, it will need to be specified in the URL.

## MySQL Access

MySQL has been set up with user:pass `docupet`:`docupet` and allows external connections so you can connect from the host with your preferred tool, such as the database extension in Jetbrains products or MySQL Workbench.

You may connect to mysql via the host at port `3306` or whichever port you decide to open on the host in the `docker run` command. 

## Other Notes
- A bare Ubuntu image was used in order to showcase that the entire stack was provisioned and configured from scratch, such as Nginx, PHP, MySQL, and the project root.
- All configuration files related to provisioning are available in the `/docker` directory for inspection.

## Possible Improvements
- Ideally, containers would only have one process running in each and they would be networked and orchestrated with docker-compose. The current solution was encapsulated in a single container as that's what the challenge document requested.
- A standalone solution such as PhpMyAdmin or Adminer would be good to offer for a no-setup database access for reviewers.
