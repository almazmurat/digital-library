# Phase 2 Automation Strategy Update

## Tool selection rationale

- Playwright was selected for browser-level high-risk smoke and access-boundary checks because the repository already uses Playwright and has CI support.
- PHPUnit/Laravel tests were reused for backend high-risk regression checks because these are the native, maintainable test assets for controllers/middleware.
- PowerShell API smoke scripts were added for fast, environment-agnostic endpoint guard and contract checks that can run locally without full CI stack replication.

## Automation organization

- qa/phase2/automation/ui: Playwright route-level and guard smoke checks.
- qa/phase2/automation/api: API smoke checks split by risk domain (auth, catalog, integration, operations).
- qa/phase2/automation/shared: reusable HTTP helper and endpoint inventory data.

## Reusability strategy

- Centralized HTTP request helper with status/error/timing capture.
- Modular scripts by risk domain to allow selective CI execution.
- Uniform case ID naming scheme across API and UI (P2-API-_, P2-UI-_).

## Maintainability strategy

- Avoid brittle UI selectors by asserting route stability and status first.
- Keep scripts small and single-purpose.
- Keep factual outputs in machine-readable JSON and human-readable logs.

## Data strategy

- Endpoint inventory is maintained in qa/phase2/automation/shared/data/phase2-endpoints.json.
- Test data in this phase is intentionally minimal and non-sensitive.

## CI fit

- Phase 2 quality-gate checks are integrated into existing CI workflow to fail fast on critical gate breaches.
- Phase 2 artifacts are uploaded to support reproducibility and research reporting.

## Research paper relevance

- Provides measurable automation coverage and runtime metrics.
- Links defect observations to risk predictions from Phase 1.
- Produces reproducible logs, reports, and tables suitable for methodology/results chapters.
