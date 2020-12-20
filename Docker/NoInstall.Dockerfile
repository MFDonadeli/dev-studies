FROM node:15

#workdir inside the container
WORKDIR /usr/src/app

#copy all the file from the current dir to /usr/src/app
COPY . .

EXPOSE 3000

CMD ["node", "index.js"]