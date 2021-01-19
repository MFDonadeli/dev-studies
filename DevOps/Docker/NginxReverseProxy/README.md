# How to run this project

Building Laravel image: docker build -t <name> laravel -f Laravel.Dockerfile.multistage

Builing Nginx image: docker build -t <name> . -f Nginx.Dockerfile.toWorkWithMultistagePhp

Create a network: docker network create laranet 

Run laravel image: docker run -d --network laranet --name laravel <image> 

Run nginx image: docker run -d --network laranet --name nginx -p 8080:80 <image>

