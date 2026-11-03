# Campus Notes Service

A small notes web app built with plain PHP (MVC) and SQLite, packaged with Docker.
Create, edit and delete notes, with a `/health` endpoint for monitoring.

## Tech stack

- PHP 8.2 (no framework, MVC structure)
- SQLite (PDO)
- Apache (via the official `php:8.2-apache` image)
- Docker

## Project structure

```
Campus-Notes-Service/
├── src/
│   ├── bootstrap.php
│   ├── public/            # web root (index.php, assets/css)
│   └── app/               # Config, Core, Controllers, Models, Views
├── docs/
│   ├── screenshots/
│   └── notes.md
├── Dockerfile
├── .dockerignore
├── .gitignore
└── README.md
```

## Run with Docker

Requirements: Docker Desktop installed and running.

```bash
git clone https://github.com/mahmoudnahal/Campus-Notes-Service.git
cd Campus-Notes-Service
docker build -t campus-notes-service .
docker run -d --name campus-notes -p 8000:80 -v notes-data:/data campus-notes-service
```

Open http://localhost:8000

## Stop and clean up

```bash
docker stop campus-notes
docker rm campus-notes
docker volume rm notes-data   # optional: deletes the saved notes
```

## Configuration

| Setting             | Default              | Description                                                                                   |
| ------------------- | -------------------- | --------------------------------------------------------------------------------------------- |
| Port mapping        | `-p 8000:80`         | Host port 8000 maps to port 80 inside the container. Change the first number if 8000 is busy. |
| `DB_PATH`           | `/data/notes.sqlite` | Location of the SQLite file. Override with `-e DB_PATH=/data/other.sqlite`.                   |
| Volume `notes-data` | `/data`              | Keeps notes after the container is removed.                                                   |

## How to test

1. Open http://localhost:8000, add a note, edit it, then delete it.
2. Check the health endpoint: http://localhost:8000/health

```json
{ "status": "ok", "database": "ok", "time": "2026-10-31T00:00:00+00:00" }
```

3. Check the container: `docker ps`

## Screenshots

See the `docs/screenshots/` folder: Docker build, running container, the app in the browser, and the health endpoint.

## Bonus features

- **Docker Compose:** `docker compose up -d --build` builds and starts the app.
- **Multi-stage build:** a first stage runs `php -l` on every PHP file, so the build fails on syntax errors.
- **Healthcheck:** the container is marked `healthy` when `/health` responds.
- **Makefile:** `make build`, `make run`, `make stop`, `make logs`.
- **GitHub Actions:** builds the image, runs the container and checks `/health` on every push and pull request.

## Notes

Technical notes are in [docs/notes.md](docs/notes.md).
