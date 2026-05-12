# KazUTB Digital Library

Production-oriented digital library platform for Kazakh University of Technology and Business (KazUTB), built with Laravel 13, PostgreSQL, Vite, and Playwright.

This repository contains the full web platform: public library portal, member cabinet, librarian operations, admin panels, API surface, and QA/test automation.

## Table of Contents

1. Project Vision
2. Core Features
3. Architecture
4. Tech Stack
5. Repository Structure
6. Prerequisites
7. Quick Start (Docker, Recommended)
8. Quick Start (Local, Non-Docker)
9. Environment Configuration
10. Database and Migrations
11. Running the Application
12. Testing and QA
13. End-to-End Testing (Playwright)
14. API and Integrations
15. Authentication and Roles
16. Internationalization
17. Frontend Build Pipeline
18. Operational Notes
19. Troubleshooting
20. Security and Secret Handling
21. Contributing Workflow
22. Release and Deployment Notes
23. License

## Project Vision

KazUTB Digital Library is a complete operational system for university library processes, not only a catalog UI.

It is designed to:

- provide public discovery of library resources,
- support authenticated member workflows (shortlists, reservations, cabinet pages),
- enable librarian operations (inventory, circulation, reservations, reporting),
- offer administrative management and integrations,
- expose API endpoints for external systems,
- maintain multilingual user experience.

## Core Features

- Public-facing pages: catalog, news, events, library information, contacts, rules.
- Catalog discovery and detail pages.
- Member cabinet workflows, including personal shortlist-related pages.
- Reservation/circulation-related domain logic and status workflows.
- Librarian and admin operational interfaces.
- Integration endpoints and service-layer orchestration.
- Notification and workflow support.
- Extensive automated test coverage (Feature/Unit/E2E).

## Architecture

High-level architecture follows a layered Laravel design:

- HTTP layer: controllers and middleware in `app/Http`.
- Domain/application services in `app/Services`.
- Eloquent models in `app/Models`.
- Route entry points in `routes/web.php` and `routes/api.php`.
- Blade UI views in `resources/views`.
- Frontend asset pipeline via Vite (`resources/js`, `resources/css`).
- PostgreSQL as primary data store.
- Optional external service integrations configured via `.env` and `config/*`.

## Tech Stack

- Backend: PHP 8.4+, Laravel 13
- Database: PostgreSQL 18 (via Docker image in compose setup)
- Frontend build: Node.js 20.19+ and Vite 8
- CSS/tooling: TailwindCSS 4
- Testing: PHPUnit 12, Laravel test runner, Playwright
- Container runtime: Docker Compose

## Repository Structure

Top-level map of key directories/files:

- `app/` Laravel application code (controllers, middleware, models, services, notifications)
- `bootstrap/` Laravel bootstrap files
- `config/` Application and integration configuration
- `database/` Migrations, factories, seeders
- `docs/` Integration/API contract artifacts
- `lang/` Localization files (`en`, `kk`, `ru`)
- `public/` Public web root and built assets
- `resources/` Blade views and frontend source
- `routes/` Web, API, and console route definitions
- `scripts/` Developer and CI helper scripts
- `tests/` Unit, feature, and e2e tests
- `docker/` Runtime configs (nginx, php, entrypoint, supervisor)
- `docker-compose.yml` Local multi-service dev stack
- `Dockerfile` App image definition
- `composer.json` PHP dependencies and scripts
- `package.json` JS dependencies and scripts

## Prerequisites

For Docker-based flow:

- Docker Desktop or Docker Engine with Compose v2

For local non-Docker flow:

- PHP 8.4+
- Composer 2+
- Node.js 20.19+
- npm 10+
- PostgreSQL 15+ (project compose uses PostgreSQL 18)

## Quick Start (Docker, Recommended)

1. Copy environment template and configure variables:

```bash
cp .env.example .env
```

2. Set required values in `.env` (especially DB and app settings).

3. Build and start services:

```bash
docker compose up --build -d app frontend-dev
```

4. Install backend dependencies in app container (if needed):

```bash
docker compose exec app composer install
```

5. Run migrations:

```bash
docker compose exec app php artisan migrate
```

6. Open application:

- App: http://localhost
- Vite dev server: http://localhost:5173

### Compose Services

- `postgres`: PostgreSQL database service
- `app`: Laravel app runtime (nginx + php-fpm)
- `frontend-dev`: Node/Vite live development server

## Quick Start (Local, Non-Docker)

1. Install PHP dependencies:

```bash
composer install
```

2. Install JS dependencies:

```bash
npm install
```

3. Configure environment:

```bash
cp .env.example .env
php artisan key:generate
```

4. Configure PostgreSQL credentials in `.env`.

5. Run migrations:

```bash
php artisan migrate
```

6. Run app and assets:

```bash
php artisan serve
npm run dev
```

## Environment Configuration

Configuration is driven by `.env` + `config/*.php`.

Important areas:

- Application: `APP_NAME`, `APP_ENV`, `APP_DEBUG`, `APP_URL`
- Database: `DB_*` / `POSTGRES_*`
- Session/cache/queue: `SESSION_*`, `CACHE_*`, queue settings
- Integrations: external auth/resource endpoints in config and env

Do not commit real secrets, credentials, access tokens, or private endpoint keys.

## Database and Migrations

- Migration files are in `database/migrations`.
- Factories in `database/factories`.
- Seeders in `database/seeders`.

Standard commands:

```bash
php artisan migrate
php artisan migrate:fresh --seed
```

## Running the Application

### Standard Laravel Dev Runtime

```bash
composer dev
```

This starts concurrent processes for app server, queue listener, logs, and Vite.

### One-command setup helper

```bash
composer setup
```

## Testing and QA

### Backend test suite

```bash
composer test
# or
php artisan test
```

### Focused/extended scripts (from `composer.json`)

Examples:

```bash
composer test:critical-paths
composer test:internal
composer test:reservation-core
composer test:integration-reservations
composer test:stewardship
```

### CI/quality scripts

```bash
composer qa:ci
composer qa:coverage-threshold
composer qa:evidence
```

## End-to-End Testing (Playwright)

Install browser dependencies:

```bash
npm run test:e2e:install
# if system deps are needed:
npm run test:e2e:install:system
```

Run tests:

```bash
npm run test:e2e
```

Playwright config is in `playwright.config.ts`.

## API and Integrations

- API routes: `routes/api.php`
- Web routes: `routes/web.php`
- Integration contract artifact: `docs/integration-api-contract.json`

Service classes for integration/business workflows are under:

- `app/Services`
- `app/Services/Admin`
- `app/Services/Library`

## Authentication and Roles

Project includes role-aware surfaces and route protection for different audiences:

- Guest/public visitors
- Authenticated members/readers
- Librarian users
- Admin users

Middleware and route grouping enforce access behavior. Authentication/session details are configured via Laravel auth/session configs and integration endpoints where applicable.

## Internationalization

Multi-language resources are stored in:

- `lang/en`
- `lang/kk`
- `lang/ru`

UI translation arrays and language keys are maintained per locale.

## Frontend Build Pipeline

- Source assets: `resources/js`, `resources/css`
- Vite config: `vite.config.js`
- Build output: `public/build`

Commands:

```bash
npm run dev
npm run build
```

## Operational Notes

- Runtime logs: `storage/logs`
- Queue/session/cache behavior is env-configurable
- Docker runtime scripts/configs are in `docker/`
- Keep `APP_DEBUG=false` in production-like environments

## Troubleshooting

### App does not start in Docker

- Verify `.env` has required values.
- Check service health:

```bash
docker compose ps
docker compose logs app --tail=200
docker compose logs postgres --tail=200
```

### Migration or DB connection issues

- Validate `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.
- Ensure PostgreSQL service is healthy.
- Re-run migrations once connectivity is confirmed.

### Frontend changes not visible

- Ensure `frontend-dev` is running.
- Confirm Vite port mapping (`5173`) and browser access.
- Rebuild assets with `npm run build` for production mode checks.

### Test failures after dependency update

- Reinstall dependencies (`composer install`, `npm install`).
- Clear framework caches:

```bash
php artisan optimize:clear
```

## Security and Secret Handling

Security practices for this repository:

- Never commit `.env` with real credentials.
- Do not commit secrets/tokens/certificates/private keys.
- Use environment variables for sensitive config.
- Rotate credentials if accidental disclosure occurs.
- Review diffs before commit to avoid leaking local machine paths or tokens.

## Contributing Workflow

1. Create a feature branch from `main`.
2. Implement changes with focused commits.
3. Run relevant tests and QA scripts.
4. Open pull request with context, screenshots (if UI), and test evidence.
5. Address review comments and keep branch up to date.

Suggested commit hygiene:

- Separate refactor, feature, and formatting changes when possible.
- Include migration notes if schema changes are introduced.
- Update docs when behavior changes.

## Release and Deployment Notes

Before release:

- Ensure migrations are safe and reversible where possible.
- Validate production env variables.
- Run backend and e2e test gates.
- Build frontend assets.
- Confirm health checks and core catalog/auth flows.

Recommended baseline release checklist:

- Dependency install success
- DB migration success
- Application health endpoint(s) reachable
- Core user journeys tested (public browse, auth, member actions)
- Admin/librarian critical operations smoke tested

## License

This project is built on Laravel foundation components that are MIT-licensed. Confirm repository-level license policy with maintainers for organization-specific distribution terms.
