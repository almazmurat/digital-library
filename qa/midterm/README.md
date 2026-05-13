# Midterm QA Implementation & Empirical Analysis

This directory contains the Midterm synthesis layer for the KazUTB Digital Library.

## Scope relationship

- Phase 1 (Assignment 1): risk baseline and prioritization.
- Phase 2 (Assignment 2): automation evidence, quality gates, CI integration, and measured metrics.
- Midterm: empirical reassessment and expansion package built from Phase 1 + Phase 2 evidence plus newly executed Midterm tests.

## Contents

- docs/: narrative deliverables and final report sections.
- metrics/: machine-readable datasets (CSV/JSON parity).
- charts/: chart-ready CSV files and generation instructions.
- evidence/: execution logs, references, and screenshot inventory.
- reports/: executive summary artifact for quick review.

## Reproducibility

1. Review source evidence mapping in qa/midterm/evidence/references/midterm-source-evidence.md.
2. Re-run Midterm new PHPUnit tests:
   - php artisan test --filter='BibliographyFormatterMidtermTest|MidtermIntegrationRiskExpansionTest'
3. Re-run Midterm new E2E tests:
   - npx playwright test tests/e2e/midterm-risk-expansion.spec.ts --reporter=list
4. Regenerate metrics/charts if source evidence changes.
5. Verify CSV/JSON parity and references before submission.
