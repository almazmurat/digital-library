# Phase 2 Evidence Index

| Evidence ID | Area | Type | Description | File Location | Status |
| --- | --- | --- | --- | --- | --- |
| P2-E-001 | API automation | Log | API smoke runner output with per-case status and elapsed time | qa/phase2/evidence/logs/phase2-api-tests.log | implemented |
| P2-E-002 | PHPUnit automation | Log | Targeted high-risk feature/API PHPUnit execution output | qa/phase2/evidence/logs/phase2-phpunit.log | implemented |
| P2-E-003 | UI automation | Log | Playwright Phase 2 UI suite output with pass/fail summary | qa/phase2/evidence/logs/phase2-playwright.log | implemented |
| P2-E-004 | Automation aggregate | Log | Consolidated API/PHPUnit/Playwright run metrics | qa/phase2/evidence/logs/phase2-automation-summary.log | implemented |
| P2-E-005 | Coverage availability | Log | Coverage driver detection result in measured environment | qa/phase2/evidence/logs/phase2-coverage.log | implemented |
| P2-E-006 | Quality gate evaluation | Log | Gate-by-gate enforced/proposed status evaluation | qa/phase2/evidence/logs/phase2-quality-gates.log | implemented |
| P2-E-007 | CI local validation | Log | Local validation of workflow and required gate artifacts | qa/phase2/evidence/logs/phase2-ci-local-validation.log | implemented |
| P2-E-008 | Gate results dataset | CSV/JSON | Source-of-truth matrix for CI gate evaluation | qa/phase2/metrics/phase2-quality-gate-results.csv; qa/phase2/metrics/phase2-quality-gate-results.json | implemented |
| P2-E-009 | Workflow implementation | YAML | Production CI workflow with phase2-quality-gates job | .github/workflows/ci.yml | implemented |
| P2-E-010 | Reusable CI snippet | YAML | Standalone Phase 2 snippet for portability and review | qa/phase2/ci/phase2-ci-snippet.yml | implemented |
| P2-E-011 | Gate policy definition | YAML | Structured gate definitions with current vs proposed tiers | qa/phase2/ci/phase2-quality-gates.yml | implemented |
| P2-E-012 | Pipeline diagram | Markdown | Text and mermaid pipeline flow for assignment and handoff | qa/phase2/ci/phase2-workflow-diagram.md | implemented |
| P2-E-013 | UI failure screenshot | Screenshot | Public news route failure captured by Playwright | qa/phase2/reports/test-results/playwright-raw/public-catalog.ui-P2-UI-CAT-004-news-page-loads-chromium/test-failed-1.png | implemented |
| P2-E-014 | UI failure context | Report | Detailed parse/runtime error context | qa/phase2/reports/test-results/playwright-raw/public-catalog.ui-P2-UI-CAT-004-news-page-loads-chromium/error-context.md | implemented |
| P2-E-015 | Execution time metrics | CSV/JSON | Bounded runtime measurements used by QG runtime gates | qa/phase2/metrics/phase2-execution-time.csv; qa/phase2/metrics/phase2-execution-time.json | implemented |
| P2-E-016 | Test execution ledger | CSV/JSON | Case-level pass/fail and defect notes across suites | qa/phase2/metrics/phase2-test-execution-log.csv; qa/phase2/metrics/phase2-test-execution-log.json | implemented |

## Remaining Limitations (Factual)

- Slack and email integrations are not configured in repository workflows; GitHub-native visibility is currently the active alerting channel.
- Proposed next-stage gates (coverage >=80 percent, static analysis, flake-rate control, 100 percent critical workflow success) are documented but not enforced.
- Current enforced gate set remains red due measured failures in API smoke, targeted PHPUnit subset, and public /news fatal error detection.
