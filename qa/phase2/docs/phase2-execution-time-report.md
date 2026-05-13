# Phase 2 Execution Time Report

Measured from:

- qa/phase2/evidence/logs/phase2-api-tests.log
- qa/phase2/evidence/logs/phase2-phpunit.log
- qa/phase2/evidence/logs/phase2-playwright.log

| Module/Feature | Number of Test Cases | Execution Time | Total Time | Gate Mapping | Notes |
| --- | --- | --- | --- | --- | --- |
| API smoke (phase2 scripts) | 10 | 38.435s | 38.435s | P2-QG-007 | runner_elapsed_ms=38435.05 |
| UI smoke (phase2 playwright specs) | 11 | 54.885s | 54.885s | P2-QG-007 | playwright_elapsed_ms=54884.76 |
| Targeted PHPUnit high-risk subset | 41 (31 pass, 6 fail, 4 skip) | 61.258s | 61.258s | P2-QG-007 | phpunit_elapsed_ms=61258.42 |
| Combined automation execution | 62 | 154.578s | 154.578s | Informational | Sum of measured suite runtimes |

Bottleneck observations:

- The /news UI route check was one of the slowest tests and failed with HTTP 500.
- API runner is stable and bounded under 40 seconds.
- PHPUnit subset includes environment-sensitive tests (sqlite versus expected DB objects).

Operational interpretation:

- Runtime thresholds are currently passing and are enforced as warn-level in the current gate model.
- Runtime trend should continue to be monitored before tightening thresholds further.
