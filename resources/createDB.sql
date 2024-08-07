CREATE DATABASE IF NOT EXISTS the_social_network;

CREATE USER IF NOT EXISTS 'nikita'@'localhost' IDENTIFIED BY 'Nikita76';

GRANT ALL PRIVILEGES ON the_social_network.* TO 'nikita'@'localhost';