FROM node:lts-alpine

RUN npm install -g @vue/cli

WORKDIR /var/www

COPY ./vue-project/package*.json ./

RUN npm install

COPY vue-project .

CMD ["npm", "run", "dev"]