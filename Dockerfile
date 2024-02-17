# Pull base image
FROM ubuntu:latest
MAINTAINER Jonathan Biard <jbiard84@gmail.com>

# Add the files to the container
COPY docker /

# Run the setup script(s)
RUN /build/setup.sh

# Define working directory
WORKDIR /

# Define default command
CMD ["/start.sh"]

# Expose ports
EXPOSE 80
EXPOSE 443
EXPOSE 3306
