# Phase 3 Part 1 — Performance Testing: Final Summary

**Project:** KazUTB Digital Library  
**Phase:** 3 — Performance & Scalability  
**Part:** 1 — Performance Testing  
**Date:** 2026-05-13  
**Prepared by:** QA Automation (GitHub Copilot Agent)

---

## Executive Summary

Performance testing was executed against three priority modules of the KazUTB Digital Library system using a bounded synthetic test methodology (1 VU sequential, PowerShell). **9 scenarios were defined, scripted, and executed.** **8 of 9 scenarios PASS** their configured latency thresholds. **1 scenario FAILS** (S08-BND-INTEGRATION — middleware rejection overhead 3 237ms vs 2 000ms threshold).

All passing endpoints exhibit response times in the **3.1–3.8 second range**, which is **6–8× above a typical production target of 500ms**. Eight bottlenecks were identified and catalogued with root-cause hypotheses and actionable recommendations. Critical recommendations (OPcache, Redis caching, integration middleware refactor) should be implemented before any production deployment.

---

## Results At a Glance

| Module                   | Scenarios               | Pass    | Fail            |
| ------------------------ | ----------------------- | ------- | --------------- |
| Catalog / Public API     | S01, S02, S03, S04, S09 | 5       | 0               |
| External Resources       | S05                     | 1       | 0               |
| Web Catalog UI           | S06, S07                | 2       | 0               |
| Integration API Boundary | S08A, S08B              | 0       | 2 sub-scenarios |
| **Total**                | **9 (10 sub)**          | **8/9** | **1/9**         |

---

## Key Findings

### Finding 1 — Uniform High Latency (CRITICAL)

All measured endpoints cluster in the 3 000–3 800ms range regardless of complexity. The root cause is believed to be PHP-FPM cold-path bootstrapping and database connection establishment without OPcache or connection pooling. **Estimated fix:** Enable OPcache + Redis caching → 30–90% latency reduction.

### Finding 2 — Integration Middleware Threshold Exceeded (CRITICAL)

The integration API correctly rejects invalid/missing credentials, but the rejection pathway takes 3 237ms average — 62% above the 2 000ms threshold. The full PHP bootstrap runs before the auth check fires. **Estimated fix:** Short-circuit middleware → rejection latency < 200ms.

### Finding 3 — Large Web Catalog Payload (HIGH)

`GET /catalog` returns 130KB of uncompressed HTML per request — the largest payload observed. Combined with 3.8s avg latency, this endpoint will be a significant bottleneck for users on slow connections. **Estimated fix:** Enable Gzip compression + Blade caching.

### Finding 4 — Low Throughput Ceiling (HIGH)

At 1 VU sequential, throughput averages 0.29 rps. Under real concurrent load, 4 PHP-FPM workers at 3.4s avg latency can serve ~1.2 requests/second total. A 100-user peak hour would overwhelm this. **Estimated fix:** PHP-FPM pool expansion + Redis caching + concurrent load test on staging.

### Finding 5 — Untestable Endpoints (MEDIUM)

`/news` returns HTTP 500 and `/api/login` times out. Both have been unresolved since Phase 2. These must be fixed before Phase 4 or production launch.

---

## Scenario Pass/Fail Matrix

| ID                  | Name                        | Result  | Avg (ms)   | p95 (ms) |
| ------------------- | --------------------------- | ------- | ---------- | -------- |
| S01-NL-CATALOG      | Normal Load — Landing       | ✅ PASS | 3 443.66   | 3 553.05 |
| S02-PL-CATALOG      | Peak Load — Catalog DB      | ✅ PASS | 3 497.38   | 3 796.10 |
| S03-NL-SUBJECTS     | Normal Load — Subjects      | ✅ PASS | 3 359.51   | 3 969.37 |
| S04-SL-MIXED        | Spike — Mixed Endpoints     | ✅ PASS | 3 464.90   | 3 659.68 |
| S05-NL-EXTRES       | Normal Load — Ext Resources | ✅ PASS | 3 077.66   | 3 334.84 |
| S06-NL-WEBCATALOG   | Normal Load — Web Catalog   | ✅ PASS | 3 784.74   | 4 037.13 |
| S07-PL-WEBCATALOG   | Peak Load — Web Catalog     | ✅ PASS | 3 639.72   | 4 014.71 |
| S08-BND-INTEGRATION | Boundary Auth               | ❌ FAIL | 3 237.12\* | 3 661.04 |
| S09-END-CATALOG     | Endurance — Landing 40req   | ✅ PASS | 3 454.20   | 3 562.67 |

\*S08 avg = middleware_overhead_avg (arithmetic mean of S08A and S08B sub-scenarios)

---

## Deliverable Checklist

| #   | Deliverable                | File                                     | Status |
| --- | -------------------------- | ---------------------------------------- | ------ |
| 1   | Test Plan                  | `docs/phase3-performance-test-plan.md`   | ✅     |
| 2   | Methodology                | `docs/phase3-performance-methodology.md` | ✅     |
| 3   | Execution Report           | `docs/phase3-execution-report.md`        | ✅     |
| 4   | Metrics Report             | `docs/phase3-metrics-report.md`          | ✅     |
| 5   | Bottleneck Analysis        | `docs/phase3-bottleneck-analysis.md`     | ✅     |
| 6   | Recommendations            | `docs/phase3-recommendations.md`         | ✅     |
| 7   | Final Summary              | `docs/phase3-final-summary.md`           | ✅     |
| 8   | Performance scripts (4)    | `performance/scripts/`                   | ✅     |
| 9   | Raw result JSON (3)        | `performance/results/`                   | ✅     |
| 10  | Execution logs (3)         | `evidence/logs/`                         | ✅     |
| 11  | Metrics CSV/JSON (6 files) | `metrics/`                               | ✅     |
| 12  | Chart CSV/instructions (5) | `charts/`                                | ✅     |
| 13  | Scenarios CSV/JSON         | `metrics/`                               | ✅     |
| 14  | README                     | `README.md`                              | ✅     |
| 15  | Traceability               | `TRACEABILITY.md`                        | ✅     |
| 16  | Changelog                  | `CHANGELOG.md`                           | ✅     |

---

## Methodology Disclosure

All tests were executed with 1-VU sequential PowerShell `Invoke-WebRequest` on a Windows 11 developer workstation. Results represent single-user sequential latency baselines, **not** concurrent production load. Full k6 concurrent load testing on a Linux staging environment is required before production capacity planning. All data is factual and reproducible; scripts are provided for re-execution.

---

## Next Steps

1. **Phase 3 Part 2:** Implement Priority 1 recommendations (OPcache, Redis caching, middleware short-circuit) and re-run all Phase 3 scenarios to measure improvement.
2. **Staging environment:** Deploy to Linux server; re-test at 50–100 VU with k6.
3. **Bug fixes:** Resolve `/news` HTTP 500 and `/api/login` timeout before Phase 4.
4. **Phase 4 planning:** Begin security and compliance testing using findings from Phases 1–3.

---

_KazUTB Digital Library — QA Phase 3 Part 1 — 2026-05-13_
