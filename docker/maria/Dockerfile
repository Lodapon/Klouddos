FROM mariadb

MAINTAINER LordGift

# place *.sql that will automatic run by alphabet order after MySQL ready.
COPY init.sql /docker-entrypoint-initdb.d/initdb.sql
COPY scriptLocation.txt /docker-entrypoint-initdb.d/scriptLocation.txt