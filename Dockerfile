FROM node:17-alpine

RUN ;kdir /app

WORKDIR /app

COPY package*.json ./

RUN yarn install

RUN yarn encore production

COPY . ./app

FROM php:7.4-apache

ENV PORT=8000

CMD ["symfony", "server:start"]