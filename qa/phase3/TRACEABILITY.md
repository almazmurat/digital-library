# Phase 3 Part 1 — Traceability Matrix

**Project:** KazUTB Digital Library  
**Phase:** 3 Part 1 — Performance Testing  
**Date:** 2026-05-13

---

## Scenario → Script → Result → Evidence

| Scenario ID         | Name                        | Script File                     | Result File                                      | Log File                        | Status  |
| ------------------- | --------------------------- | ------------------------------- | ------------------------------------------------ | ------------------------------- | ------- |
| S01-NL-CATALOG      | Normal Load — Landing       | `perf-catalog-api.ps1`          | `catalog-api-perf-20260513-133438.json`          | `perf-catalog-api.log`          | ✅ PASS |
| S02-PL-CATALOG      | Peak Load — Catalog DB      | `perf-catalog-api.ps1`          | `catalog-api-perf-20260513-133438.json`          | `perf-catalog-api.log`          | ✅ PASS |
| S03-NL-SUBJECTS     | Normal Load — Subjects      | `perf-catalog-api.ps1`          | `catalog-api-perf-20260513-133438.json`          | `perf-catalog-api.log`          | ✅ PASS |
| S04-SL-MIXED        | Spike — Mixed Endpoints     | `perf-catalog-api.ps1`          | `catalog-api-perf-20260513-133438.json`          | `perf-catalog-api.log`          | ✅ PASS |
| S05-NL-EXTRES       | Normal Load — Ext Resources | `perf-web-public.ps1`           | `web-public-perf-20260513-134213.json`           | `perf-web-public.log`           | ✅ PASS |
| S06-NL-WEBCATALOG   | Normal Load — Web Catalog   | `perf-web-public.ps1`           | `web-public-perf-20260513-134213.json`           | `perf-web-public.log`           | ✅ PASS |
| S07-PL-WEBCATALOG   | Peak Load — Web Catalog     | `perf-web-public.ps1`           | `web-public-perf-20260513-134213.json`           | `perf-web-public.log`           | ✅ PASS |
| S08-BND-INTEGRATION | Boundary Auth               | `perf-integration-boundary.ps1` | `integration-boundary-perf-20260513-134513.json` | `perf-integration-boundary.log` | ❌ FAIL |
| S09-END-CATALOG     | Endurance 40 req            | `perf-catalog-api.ps1`          | `catalog-api-perf-20260513-133438.json`          | `perf-catalog-api.log`          | ✅ PASS |

---

## Scenario → Metric → Bottleneck → Recommendation

| Scenario ID         | Metric File                      | Bottleneck IDs              | Recommendation IDs                |
| ------------------- | -------------------------------- | --------------------------- | --------------------------------- |
| S01-NL-CATALOG      | `phase3-performance-results.csv` | BN-001                      | R-001, R-002                      |
| S02-PL-CATALOG      | `phase3-performance-results.csv` | BN-001, BN-004              | R-001, R-002, R-006               |
| S03-NL-SUBJECTS     | `phase3-performance-results.csv` | BN-001, BN-005              | R-001, R-002, R-007               |
| S04-SL-MIXED        | `phase3-performance-results.csv` | BN-001, BN-004              | R-001, R-002, R-006               |
| S05-NL-EXTRES       | `phase3-performance-results.csv` | BN-001                      | R-001, R-002                      |
| S06-NL-WEBCATALOG   | `phase3-performance-results.csv` | BN-001, BN-003, BN-004      | R-001, R-002, R-004, R-005        |
| S07-PL-WEBCATALOG   | `phase3-performance-results.csv` | BN-001, BN-003, BN-004      | R-001, R-002, R-004, R-005, R-006 |
| S08-BND-INTEGRATION | `phase3-performance-results.csv` | BN-002                      | R-003                             |
| S09-END-CATALOG     | `phase3-performance-results.csv` | BN-001, BN-008              | R-001, R-002                      |
| N/A (excluded)      | N/A                              | BN-006 (/news 500)          | R-008                             |
| N/A (excluded)      | N/A                              | BN-007 (/api/login timeout) | R-009                             |

---

## Document Traceability

| Document                                | Purpose                                      | Depends On                       |
| --------------------------------------- | -------------------------------------------- | -------------------------------- |
| `phase3-performance-test-plan.md`       | Defines scope, scenarios, pass/fail criteria | None                             |
| `phase3-performance-methodology.md`     | Explains tool choice, measurement approach   | Test Plan                        |
| `phase3-execution-report.md`            | Documents commands run and results           | Scripts, Result JSON files       |
| `phase3-metrics-report.md`              | Tabulates all measured metrics               | `phase3-performance-results.csv` |
| `phase3-bottleneck-analysis.md`         | Analyses root causes for each bottleneck     | Metrics Report                   |
| `phase3-recommendations.md`             | Prioritised remediation steps                | Bottleneck Analysis              |
| `phase3-final-summary.md`               | Executive summary of all above               | All docs                         |
| `phase3-scenarios.csv/json`             | Scenario definitions                         | Test Plan                        |
| `phase3-performance-results.csv/json`   | Raw scenario measurements                    | Execution Report                 |
| `phase3-resource-observations.csv/json` | Host resource snapshots                      | Execution Report                 |
| `phase3-bottlenecks.csv/json`           | Structured bottleneck catalogue              | Bottleneck Analysis              |
| Chart CSVs (4 files)                    | Data for Excel/Google Sheets visualisation   | Performance Results              |
| `phase3-chart-instructions.md`          | How to render charts                         | Chart CSVs                       |

---

## Run IDs → Files

| Run ID          | Scenarios Covered       | Result File                                      |
| --------------- | ----------------------- | ------------------------------------------------ |
| 20260513-133438 | S01, S02, S03, S04, S09 | `catalog-api-perf-20260513-133438.json`          |
| 20260513-134213 | S05, S06, S07           | `web-public-perf-20260513-134213.json`           |
| 20260513-134513 | S08A, S08B              | `integration-boundary-perf-20260513-134513.json` |

---

_KazUTB Digital Library — QA Phase 3 Part 1 — 2026-05-13_
