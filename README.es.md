# CIIE La Ferrere

Este proyecto es un administrador de usuarios y clases para el Centro de Capacitación, Información e Investigación Educativa N°201 “Julio R. Cao” de Gregorio de Laferrere en la Matanza (CIIE 201)

## Funcionalidades

- Administración de usuarios de sistema, profesores y alumnos
- Creación de cursos y asignación de alumnos y profesores
- Sistema de asistencia
- Registro de evaluaciones
- Impresión y envío de certificados


## Instalación

Para ejecutar el sistema localmente, simplemente correr docker-compose

```
docker-compose up -d --build
```

Una vez generadas las imagenes, todos los comandos de Symfony o de composer deben ejecutarse en la consola de la imagen "php"

Cuando la imagen se genera por primera vez, se deberían ejecutar las migraciones de doctrine, se puede chequear el estado de esto con

```
php bin/console doctrine:migrations:status
```

En caso de que no se hayan ejecutado o que haya migraciones disponibles, se puede forzar la ejecución con el comando:

```
php bin/console doctrine:migrations:migrate
```

En caso de que se quiera tener información, usuarios y datos para probar, se pueden generar a través de doctrine fixtures (IMPORTANTE: en caso de que ya haya datos este comando los eliminara y generará nuevos)

```
php bin/console doctrine:fixtures:load
```

## Tecnologias

- PHP 8.2
- Symfony 7.0.2
- Doctrine 2.11
- EasyAdmin 4.14