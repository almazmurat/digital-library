# QA Phase 3 — Assignment 3 Package

Project: KazUTB Digital Library  
Status: Complete (Part 1 and Part 2)  
Date: 2026-05-13

---

## Overview

This directory contains all Phase 3 artifacts:

1. Part 1: Performance testing baseline.
2. Part 2: Mutation testing campaign.

Key outcomes:

1. Performance: 8/9 scenarios PASS, 1 FAIL.
2. Mutation: 14 mutants executed, 12 killed, 2 survived, overall score 85.71%.

---

## Directory Structure

```
qa/phase3/
├── README.md
├── TRACEABILITY.md
├── CHANGELOG.md
│
├── docs/
│   ├── phase3-performance-test-plan.md
│   ├── phase3-performance-methodology.md
│   ├── phase3-execution-report.md
│   ├── phase3-metrics-report.md
│   ├── phase3-bottleneck-analysis.md
│   ├── phase3-recommendations.md
│   ├── phase3-final-summary.md
│   ├── phase3-mutation-plan.md
│   ├── phase3-mutation-execution-report.md
│   ├── phase3-mutation-score-report.md
│   ├── phase3-mutation-gap-analysis.md
│   ├── phase3-mutation-recommendations.md
│   └── phase3-mutation-final-summary.md
│
├── metrics/
│   ├── phase3-scenarios.csv
│   ├── phase3-scenarios.json
│   ├── phase3-performance-results.csv
│   ├── phase3-performance-results.json
│   ├── phase3-resource-observations.csv
│   ├── phase3-resource-observations.json
│   ├── phase3-bottlenecks.csv
│   ├── phase3-bottlenecks.json
│   ├── phase3-mutants.csv
│   ├── phase3-mutants.json
│   ├── phase3-mutation-results.csv
│   ├── phase3-mutation-results.json
│   ├── phase3-mutation-score.csv
│   ├── phase3-mutation-score.json
│   ├── phase3-mutation-gaps.csv
│   └── phase3-mutation-gaps.json
│
├── charts/
│   ├── phase3-response-time-chart.csv
│   ├── phase3-throughput-chart.csv
│   ├── phase3-error-rate-chart.csv
│   ├── phase3-resource-usage-chart.csv
│   ├── phase3-chart-instructions.md
│   ├── phase3-mutation-score-chart.csv
│   ├── phase3-mutant-status-chart.csv
│   └── phase3-mutation-chart-instructions.md
│
├── performance/
│   ├── scripts/
│   └── results/
│
├── mutation/
│   ├── plans/
│   │   └── run-phase3-mutation.ps1
│   └── results/
│       └── mutation-run-20260513-140552.json
│
└── evidence/
    ├── logs/
    └── references/
```

---

## Quick Results

### Part 1 Performance

| Area      | Result                  |
| --------- | ----------------------- |
| Scenarios | 9                       |
| Pass      | 8                       |
| Fail      | 1 (S08-BND-INTEGRATION) |

### Part 2 Mutation

| Module                              | Created | Killed | Survived | Score (%) |
| ----------------------------------- | ------: | -----: | -------: | --------: |
| Integration Boundary Middleware     |       3 |      3 |        0 |    100.00 |
| Integration Reservations Read API   |       3 |      3 |        0 |    100.00 |
| Integration Reservations Mutate API |       4 |      3 |        1 |     75.00 |
| Integration Document Management API |       4 |      3 |        1 |     75.00 |
| Overall                             |      14 |     12 |        2 |     85.71 |

---

## Re-Run Commands

### Performance (Part 1)

```powershell
pwsh -File "performance/scripts/run-phase3-performance.ps1" -BaseUrl "http://localhost"
```

### Mutation (Part 2)

```powershell
pwsh -File "mutation/plans/run-phase3-mutation.ps1"
```

---

## Methodology Disclosure

Part 1 uses bounded synthetic sequential HTTP timing on local Windows environment.  
Part 2 uses controlled manual mutation (scripted), one mutant at a time with source restoration and targeted module tests.

---

KazUTB Digital Library — QA Phase 3
