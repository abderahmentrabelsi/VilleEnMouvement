#!/bin/bash

# a lazy ass solution "upload" local db to remote target.
# this is also known as gadma. but what can you do.

set -x  # Enable verbose mode

# Source DB credentials
SRC_DB_HOST='127.0.0.1'
SRC_DB_PORT='3306'
SRC_DB_DATABASE='villenmouvement'
SRC_DB_USERNAME='root'
SRC_DB_PASSWORD='root'

# Destination DB credentials
DST_DB_HOST='40.76.244.158'
DST_DB_PORT='3306'
DST_DB_DATABASE='villenmouvement'
DST_DB_USERNAME='root'
DST_DB_PASSWORD='change-me'

# Create a dump of the source database
mysqldump -h $SRC_DB_HOST -P $SRC_DB_PORT -u $SRC_DB_USERNAME -p$SRC_DB_PASSWORD $SRC_DB_DATABASE > dump.sql

# Generate a SQL file to drop existing tables
echo "SET FOREIGN_KEY_CHECKS = 0;" > drop_tables.sql
MYSQL_PWD=$DST_DB_PASSWORD mysql -h $DST_DB_HOST -P $DST_DB_PORT -u $DST_DB_USERNAME $DST_DB_DATABASE \
  -Nse 'SHOW TABLES' | awk '{ print "DROP TABLE", $1";" }' >> drop_tables.sql
echo "SET FOREIGN_KEY_CHECKS = 1;" >> drop_tables.sql

# Execute the SQL file to drop existing tables
MYSQL_PWD=$DST_DB_PASSWORD mysql -h $DST_DB_HOST -P $DST_DB_PORT -u $DST_DB_USERNAME $DST_DB_DATABASE < drop_tables.sql

# Import the dump into the destination database
mysql -h $DST_DB_HOST -P $DST_DB_PORT -u $DST_DB_USERNAME -p$DST_DB_PASSWORD $DST_DB_DATABASE < dump.sql

# Optional: Remove dump and temporary SQL files
rm dump.sql drop_tables.sql
