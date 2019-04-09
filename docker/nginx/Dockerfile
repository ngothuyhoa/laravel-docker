FROM nginx:1.15.10

RUN apt-get update -y && \
	apt-get install -y openssl vim

#WORKDIR /var/www
#ADD . /var/www
#COPY . /var/www
#COPY ./docker/nginx/key-https.sh /scripts/key-https.sh

#RUN /bin/sh -c cd var/www/docker/nginx/
#RUN /bin/sh -c ls

#ENTRYPOINT ['/var/www/docker/nginx/key-https.sh']

EXPOSE 80