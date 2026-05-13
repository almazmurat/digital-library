# QA Phase 3 Part 1 — Performance Testing

**Project:** KazUTB Digital Library  
**Status:** Complete  
**Date:** 2026-05-13  
**Test type:** Bounded synthetic (1 VU sequential, PowerShell)  
**Results:** 8/9 scenarios PASS; 1 FAIL (S08 integration middleware threshold)

---

## Overview

This directory contains all artifacts for **Phase 3 Part 1 — Performance Testing** of the KazUTB Digital Library QA programme.

Three priority modules were tested under 9 load scenarios using PowerShell `Invoke-WebRequest` as the load generation tool (k6 not available in this environment). All measurements are disclosed as bounded synthetic (1 VU sequential).

---

## Directory Structure

```
qa/phase3/
├── README.md                    ← This file
├── TRACEABILITY.md              ← Scenario-to-evidence traceability matrix
├── CHANGELOG.md                 ← Change log for this phase
│
├── docs/
│   ├── phase3-performance-test-plan.md
│   ├── phase3-performance-methodology.md
│   ├── phase3-execution-report.md
│   ├── phase3-metrics-report.md
│   ├── phase3-bottleneck-analysis.md
│   ├── phase3-recommendations.md
│   └── phase3-final-summary.md
│
├── metrics/
│   ├── phase3-scenarios.csv                ← 9 scenario definitions
│   ├── phase3-scenarios.json
│   ├── phase3-performance-results.csv      ← Measured results per scenario
│   ├── phase3-performance-results.json
│   ├── phase3-resource-observations.csv    ← Host resource snapshots
│   ├── phase3-resource-observations.json
│   ├── phase3-bottlenecks.csv              ← 8 bottleneck catalogue entries
│   └── phase3-bottlenecks.json
│
├── charts/
│   ├── phase3-response-time-chart.csv
│   ├── phase3-throughput-chart.csv
│   ├── phase3-error-rate-chart.csv
│   ├── phase3-resource-usage-chart.csv
│   └── phase3-chart-instructions.md       ← How to render in Excel/Google Sheets
│
├── performance/
│   ├── scripts/
│   │   ├── perf-catalog-api.ps1            ← S01-S04, S09
│   │   ├── perf-web-public.ps1             ← S05-S07
│   │   ├── perf-integration-boundary.ps1   ← S08
│   │   └── run-phase3-performance.ps1      ← Master orchestrator
│   └── results/
│       ├── catalog-api-perf-20260513-133438.json
│       ├── web-public-perf-20260513-134213.json
│       └── integration-boundary-perf-20260513-134513.json
│
└── evidence/
    └── logs/
        ├── perf-catalog-api.log
        ├── perf-web-public.log
        └── perf-integration-boundary.log
```

---

## Quick Results

| Scenario            | Module             | Pass    | Avg (ms) | p95 (ms) |
| ------------------- | ------------------ | ------- | -------- | -------- |
| S01-NL-CATALOG      | Catalog API        | ✅      | 3 443    | 3 553    |
| S02-PL-CATALOG      | Catalog API        | ✅      | 3 497    | 3 796    |
| S03-NL-SUBJECTS     | Catalog API        | ✅      | 3 359    | 3 969    |
| S04-SL-MIXED        | Catalog API        | ✅      | 3 464    | 3 659    |
| S05-NL-EXTRES       | External Resources | ✅      | 3 077    | 3 334    |
| S06-NL-WEBCATALOG   | Web Catalog UI     | ✅      | 3 784    | 4 037    |
| S07-PL-WEBCATALOG   | Web Catalog UI     | ✅      | 3 639    | 4 014    |
| S08-BND-INTEGRATION | Integration API    | ❌ FAIL | 3 237\*  | 3 661    |
| S09-END-CATALOG     | Catalog API        | ✅      | 3 454    | 3 562    |

\*S08 avg = middleware overhead average (threshold = 2 000ms)

---

## How to Re-Run

### Individual scripts

```powershell
# Catalog API (S01–S04, S09)
pwsh -File "performance/scripts/perf-catalog-api.ps1" -BaseUrl "http://localhost" -OutputDir "performance/results"

# Web/Public (S05–S07)
pwsh -File "performance/scripts/perf-web-public.ps1" -BaseUrl "http://localhost" -OutputDir "performance/results"

# Integration boundary (S08)
pwsh -File "performance/scripts/perf-integration-boundary.ps1" -BaseUrl "http://localhost" -OutputDir "performance/results"
```

### Master orchestrator

```powershell
pwsh -File "performance/scripts/run-phase3-performance.ps1" -BaseUrl "http://localhost"
```

> Requires: Nginx running on localhost:80, PHP-FPM serving Laravel 13.2.

---

## Methodology Disclosure

All tests use PowerShell `Invoke-WebRequest` at 1 VU (sequential) — `dataset_type = bounded_synthetic`. Results are single-user latency baselines. Concurrent load testing requires k6/Locust on a Linux staging environment.

---

## Related Documents

- [Phase 2 QA Artifacts](../phase2/) — functional and integration testing baseline
- [Project Context](../../PROJECT_CONTEXT.md)
- [QA Overview](../README.md)

---

_KazUTB Digital Library — QA Phase 3 Part 1 — 2026-05-13_
