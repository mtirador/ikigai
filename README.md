
<p align="center">
    <img src="./web/images/morado.png" height="100px">
    <h1 align="center">IKIGAI</h1>
    <br>
</p>
Ikigai is an application for emotional management and personal goal setting.

This project is a Yii2 application configured to run within a Docker container. It uses PHP 7.4 with Apache as the web server and MySQL 5.7 as the database.

## Requirements

- Docker
- Docker Compose
  
## Installation and Setup

### Clone the repository

```bash
git clone https://github.com/mtirador/ikigai.git
cd ikigai

```
### Download dependencies

```bash
docker-compose run --rm php composer install
```

### Install with Docker   
    
Start the container

    docker-compose up -d
    
You can then access the application through the following URL:

    http://127.0.0.1:8000
