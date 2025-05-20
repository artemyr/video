# Разработка

```bash
npm run dev
```

# Сборка

```bash
npm run build
```

# Докер

```bash
docker run --name nginx-video -v ./dist/:/usr/share/nginx/html:ro -p 80:80 -d nginx
```