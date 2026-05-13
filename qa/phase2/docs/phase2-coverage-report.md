# Phase 2 Automation Coverage Report

Source references:

- qa/phase1/docs/phase1-risk-register.md
- qa/phase2/docs/phase2-automated-test-cases.md
- qa/phase2/evidence/logs/phase2-automation-summary.log

Coverage interpretation rule used in this phase:

- Coverage % per module is derived from executed Phase 2 automated cases mapped to the planned high-risk checks for that module.

| Module/Feature            | High-Risk Function                            | Automated? | Coverage % | Evidence                                    | Notes                                                  |
| ------------------------- | --------------------------------------------- | ---------- | ---------- | ------------------------------------------- | ------------------------------------------------------ |
| Authentication            | Session and protected endpoint guard behavior | Yes        | 100        | phase2-api-tests.log                        | 3/3 planned auth checks executed                       |
| Authorization/RBAC        | Guest access to protected role routes         | Partial    | 75         | phase2-playwright.log, phase2-api-tests.log | 6/8 planned checks executed with mixed outcomes        |
| Catalog/Public            | Public route/API stability                    | Partial    | 87.5       | phase2-playwright.log, phase2-api-tests.log | 7/8 executed checks, one failed on /news 500           |
| Circulation/Operations    | Internal ops access boundaries                | Partial    | 66.7       | phase2-api-tests.log, phase2-playwright.log | 4/6 checks executed; one endpoint expectation mismatch |
| Integration API           | Boundary and reservations path behavior       | Partial    | 50         | phase2-api-tests.log                        | 2/4 checks executed; both failed due 404 in host run   |
| Admin Critical Operations | Admin route guard behavior                    | Partial    | 50         | phase2-api-tests.log, phase2-playwright.log | 2/4 checks executed with one failure                   |
| Shortlist/Member account  | Member endpoint protection for guests         | Yes        | 100        | phase2-api-tests.log, phase2-playwright.log | 3/3 mapped checks executed                             |

Overall high-risk module coverage in Phase 2:

- Modules with at least partial automation: 7/7 (100%)
- Modules with fully passing automation in current run: 2/7

This report captures factual execution status, not aspirational pass status.
