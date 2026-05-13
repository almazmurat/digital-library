# Phase 3 — Traceability Matrix

Project: KazUTB Digital Library  
Date: 2026-05-13

---

## Part 1 Performance Traceability

| Requirement                             | Artifact                                 | Evidence                               |
| --------------------------------------- | ---------------------------------------- | -------------------------------------- |
| Design scenarios and bounded load model | `metrics/phase3-scenarios.csv`           | `docs/phase3-performance-test-plan.md` |
| Execute performance scripts             | `performance/scripts/*.ps1`              | `evidence/logs/perf-*.log`             |
| Collect measured metrics                | `metrics/phase3-performance-results.csv` | `performance/results/*.json`           |
| Analyze bottlenecks                     | `metrics/phase3-bottlenecks.csv`         | `docs/phase3-bottleneck-analysis.md`   |
| Provide recommendations                 | `docs/phase3-recommendations.md`         | Recommendation table and priorities    |

---

## Part 2 Mutation Traceability

| Mutation Requirement                       | Artifact                                                                           | Evidence                                       |
| ------------------------------------------ | ---------------------------------------------------------------------------------- | ---------------------------------------------- |
| Select critical modules with bounded scope | `docs/phase3-mutation-plan.md`                                                     | Module selection table + bounded rationale     |
| Define mutant inventory                    | `metrics/phase3-mutants.csv` / `metrics/phase3-mutants.json`                       | 14-mutant registry                             |
| Execute tests against each mutant          | `metrics/phase3-mutation-results.csv` / `metrics/phase3-mutation-results.json`     | `evidence/logs/phase3-mutation-*.log`          |
| Preserve raw mutation run payload          | `mutation/results/mutation-run-20260513-140552.json`                               | Script-generated run object                    |
| Compute module and overall mutation score  | `metrics/phase3-mutation-score.csv` / `metrics/phase3-mutation-score.json`         | `docs/phase3-mutation-score-report.md`         |
| Analyze surviving mutants and gaps         | `metrics/phase3-mutation-gaps.csv` / `metrics/phase3-mutation-gaps.json`           | `docs/phase3-mutation-gap-analysis.md`         |
| Produce actionable improvements            | `docs/phase3-mutation-recommendations.md`                                          | P1/P2/P3 recommendations                       |
| Provide chart-ready mutation data          | `charts/phase3-mutation-score-chart.csv` / `charts/phase3-mutant-status-chart.csv` | `charts/phase3-mutation-chart-instructions.md` |

---

## Mutation Run Mapping

| Run ID          | Mutants | Killed | Survived | Result File                           |
| --------------- | ------: | -----: | -------: | ------------------------------------- |
| 20260513-140552 |      14 |     12 |        2 | `metrics/phase3-mutation-results.csv` |

---

## Surviving Mutants to Gap Artifacts

| Mutant ID   | Status   | Gap Artifact Row                   | Recommendation                                         |
| ----------- | -------- | ---------------------------------- | ------------------------------------------------------ |
| MUT-MUT-004 | Survived | `metrics/phase3-mutation-gaps.csv` | Strengthen `ReservationMutateTest` context assertions  |
| MUT-DOC-004 | Survived | `metrics/phase3-mutation-gaps.csv` | Strengthen `DocumentManagementTest` context assertions |

---

KazUTB Digital Library — QA Phase 3
