# Phase 2 Quality Gates

| Quality Gate ID | Metric                              | Threshold                 | Rationale                                                 | Importance | Enforcement Level | Current Result                 | Status |
| --------------- | ----------------------------------- | ------------------------- | --------------------------------------------------------- | ---------- | ----------------- | ------------------------------ | ------ |
| P2-G-001        | API smoke pass rate                 | >= 90%                    | Critical API contracts and access guards should be stable | High       | fail              | 70.00% (7/10)                  | Fail   |
| P2-G-002        | UI smoke pass rate                  | >= 90%                    | Public and access-boundary pages must remain stable       | High       | fail              | 90.91% (10/11)                 | Pass   |
| P2-G-003        | Targeted PHPUnit pass rate          | >= 90%                    | High-risk PHPUnit subset should be mostly green           | High       | fail              | 83.78% (31/37, skips excluded) | Fail   |
| P2-G-004        | Public critical route server errors | 0 unexpected 5xx in suite | Prevent user-visible outages in critical public routes    | High       | fail              | /news returned 500             | Fail   |
| P2-G-005        | API smoke runtime                   | <= 60s                    | Keep CI smoke fast and actionable                         | Medium     | fail              | 38.435s                        | Pass   |
| P2-G-006        | UI smoke runtime                    | <= 90s                    | Keep browser smoke bounded                                | Medium     | warn              | 54.885s                        | Pass   |
| P2-G-007        | PHPUnit targeted runtime            | <= 90s                    | Keep backend gate bounded                                 | Medium     | warn              | 61.258s                        | Pass   |
| P2-G-008        | Coverage driver availability        | pcov or xdebug available  | Required for reliable line coverage metric collection     | Medium     | warn              | blocked (driver not detected)  | Warn   |
