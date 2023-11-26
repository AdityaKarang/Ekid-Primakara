FROM node:14-alpine AS build

# buat folder 'app' pada direktori yang sedang dikerjakan
WORKDIR /app

# salin 'package.json' dan 'package-lock.json' (jika ada)
COPY package*.json ./

# pasang dependecy proyek
RUN npm install

# salin berkas-berkas proyek serta folder-foldernya ke direktori yang sedang dikerjakan (misal. folder 'app)
COPY . .

ENV NODE_OPTIONS=--max_old_space_size=1024

# bangun aplikasi untuk produksi dengan minifikasi
# RUN npm run build


FROM nginx:1.19.0-alpine AS prod-stage

COPY ./nginx/nginx.conf /etc/nginx/nginx.conf

## Remove default nginx index page
RUN rm -rf /usr/share/nginx/html/*

COPY --from=build /app/dist /usr/share/nginx/html
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]