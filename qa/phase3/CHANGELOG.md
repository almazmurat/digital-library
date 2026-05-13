# CHANGELOG — QA Phase 3

All notable changes to QA Phase 3 artifacts are documented here.

---

## [Phase 3 Part 1] — 2026-05-13

### Added

**Scenarios (9 defined)**

- `metrics/phase3-scenarios.csv` — 9 load scenario definitions across 3 modules
- `metrics/phase3-scenarios.json` — JSON equivalent

**Performance Scripts (4 files)**

- `performance/scripts/perf-catalog-api.ps1` — S01-S04, S09 (Catalog/Public API)
- `performance/scripts/perf-web-public.ps1` — S05-S07 (External Resources + Web Catalog)
- `performance/scripts/perf-integration-boundary.ps1` — S08 (Integration API boundary)
- `performance/scripts/run-phase3-performance.ps1` — Master orchestrator

**Execution Results (3 run files)**

- `performance/results/catalog-api-perf-20260513-133438.json` — Run ID 20260513-133438
- `performance/results/web-public-perf-20260513-134213.json` — Run ID 20260513-134213
- `performance/results/integration-boundary-perf-20260513-134513.json` — Run ID 20260513-134513

**Execution Logs (3 files)**

- `evidence/logs/perf-catalog-api.log`
- `evidence/logs/perf-web-public.log`
- `evidence/logs/perf-integration-boundary.log`

**Metrics (6 files)**

- `metrics/phase3-performance-results.csv` — Row per scenario, all latency + throughput
- `metrics/phase3-performance-results.json`
- `metrics/phase3-resource-observations.csv` — 11 host resource snapshots
- `metrics/phase3-resource-observations.json`
- `metrics/phase3-bottlenecks.csv` — 8 bottleneck entries
- `metrics/phase3-bottlenecks.json`

**Charts (5 files)**

- `charts/phase3-response-time-chart.csv` — avg/median/p95/threshold per scenario
- `charts/phase3-throughput-chart.csv` — rps per scenario
- `charts/phase3-error-rate-chart.csv` — success/fail counts per scenario
- `charts/phase3-resource-usage-chart.csv` — host resource snapshots for line chart
- `charts/phase3-chart-instructions.md` — rendering guide for Excel/Google Sheets

**Documentation (7 docs + root files)**

- `docs/phase3-performance-test-plan.md`
- `docs/phase3-performance-methodology.md`
- `docs/phase3-execution-report.md`
- `docs/phase3-metrics-report.md`
- `docs/phase3-bottleneck-analysis.md`
- `docs/phase3-recommendations.md`
- `docs/phase3-final-summary.md`
- `README.md`
- `TRACEABILITY.md`
- `CHANGELOG.md` (this file)

### Test Results Summary

| Scenario            | Result   | Avg (ms)   | p95 (ms) |
| ------------------- | -------- | ---------- | -------- |
| S01-NL-CATALOG      | PASS     | 3 443.66   | 3 553.05 |
| S02-PL-CATALOG      | PASS     | 3 497.38   | 3 796.10 |
| S03-NL-SUBJECTS     | PASS     | 3 359.51   | 3 969.37 |
| S04-SL-MIXED        | PASS     | 3 464.90   | 3 659.68 |
| S05-NL-EXTRES       | PASS     | 3 077.66   | 3 334.84 |
| S06-NL-WEBCATALOG   | PASS     | 3 784.74   | 4 037.13 |
| S07-PL-WEBCATALOG   | PASS     | 3 639.72   | 4 014.71 |
| S08-BND-INTEGRATION | **FAIL** | 3 237.12\* | 3 661.04 |
| S09-END-CATALOG     | PASS     | 3 454.20   | 3 562.67 |

\*S08 avg = middleware_overhead_avg; threshold = 2 000ms; overage = 62%

### Bottlenecks Identified (8)

- BN-001 CRITICAL — Uniform high latency 3.1–3.8s (all modules)
- BN-002 CRITICAL — Integration middleware rejection overhead 3 237ms (S08 FAIL)
- BN-003 HIGH — Web catalog 130KB HTML payload
- BN-004 HIGH — Throughput ceiling 0.26–0.33 rps at 1 VU
- BN-005 MEDIUM — /api/v1/subjects p95 variance (3 969ms)
- BN-006 MEDIUM — /news HTTP 500 (untestable)
- BN-007 MEDIUM — /api/login timeout (untestable)
- BN-008 LOW — No OPcache warm-up benefit in endurance

### Recommendations Added (10)

- R-001 Enable PHP OPcache (P1)
- R-002 Add Redis response caching (P1)
- R-003 Refactor integration middleware short-circuit (P1)
- R-004 Enable Nginx Gzip compression (P2)
- R-005 Blade partial caching for /catalog (P2)
- R-006 PHP-FPM pool tuning (P2)
- R-007 Add index on subjects table (P2)
- R-008 Fix /news HTTP 500 (P3)
- R-009 Diagnose /api/login timeout (P3)
- R-010 Full concurrent k6 test on Linux staging (P3)

---

## Previous Phases

- Phase 2 Part 3 (commit ea80e55) — Integration and API functional testing complete
- Phase 2 Midterm (commit 87ac5bb) — Midterm QA report complete
- Phase 1 — Unit and feature test baseline

---

_KazUTB Digital Library — QA Team — 2026-05-13_
