# Phase 2 Defects vs Expected Risk Report

Source references:

- Phase 1 risk register: qa/phase1/docs/phase1-risk-register.md
- Automation results: qa/phase2/evidence/logs/phase2-automation-summary.log

| Module/Feature          | High-Risk Level | Expected Defects                 | Defects Found         | Pass/Fail | Notes                                                    |
| ----------------------- | --------------- | -------------------------------- | --------------------- | --------- | -------------------------------------------------------- |
| Authentication          | P0              | Low-to-medium (guard edge cases) | 0 in API auth smoke   | Pass      | Auth guard responses behaved as expected                 |
| Authorization/RBAC      | P1              | Medium                           | 3 in targeted PHPUnit | Fail      | Internal access expectations mismatched redirects/status |
| Catalog/Public routes   | P0              | Medium                           | 1 in UI smoke         | Fail      | /news returned HTTP 500                                  |
| Circulation/Operations  | P0              | Medium                           | 1 in API smoke        | Fail      | Admin/integration expectation mismatch surfaced          |
| Integration API         | P1              | Medium                           | 2 in API smoke        | Fail      | Integration endpoints returned 404 in host run           |
| Admin operations        | P1              | Medium                           | 1 in API smoke        | Fail      | /admin/integrations returned 404 to anonymous request    |
| Data/coverage readiness | P0 (R13)        | Medium                           | 1 process defect      | Fail      | Coverage driver unavailable in local run, metric blocked |

Summary:

- Total defects/issues observed in Phase 2 measured runs: 8
- Predicted high-risk concentration from Phase 1 was confirmed in public/catalog and authorization surfaces.
