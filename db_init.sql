# db initializer
CREATE DATABASE blank_project;
GRANT ALL PRIVILEGES ON blank_project.* TO 'root'@'%' WITH GRANT OPTION;
FLUSH PRIVILEGES;