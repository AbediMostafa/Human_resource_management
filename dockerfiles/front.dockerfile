FROM node:14-alpine
WORKDIR /app
EXPOSE 8080
CMD npm rebuild; npm run dev