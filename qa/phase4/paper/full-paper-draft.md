# Full Paper Draft

Working title:
Risk-Based QA Evolution in the KazUTB Digital Library: From Baseline Risk Mapping to Experimental Resilience Evidence

## Abstract

This paper presents an empirical QA case study for the KazUTB Digital Library repository, focusing on how a risk-based testing strategy evolved into a multi-layer evidence framework across four stages: baseline risk definition (phase1), automation and quality-gate governance (phase2), midterm empirical reassessment, and experiment-backed synthesis (phase3).

The method integrates repository traceability artifacts, structured metrics datasets, and mapped figure evidence rather than isolated benchmark outputs. Reported evidence includes phase2 automation and gate metrics (for example weighted high-risk coverage of 75.0% and gate distribution pass=5/fail=3/warn=1), midterm reassessment outputs (including 8/8 newly added tests passed), and phase3 experimental results (performance scenario pass profile, mutation score of 85.71%, and bounded chaos recovery availability of 100.00%).

Findings indicate measurable growth in QA process maturity, while also showing persistent concentration of risk around integration-boundary behavior across phases. The contribution of this work is a repository-grounded synthesis model and claims-to-evidence discipline that improves interpretive reliability for project-scale QA research reporting.

The study is intentionally bounded by local/synthetic execution contexts and requires external literature integration for final scholarly positioning [citation needed] [external reference required].

## Introduction

Digital library systems in university environments combine public information access with role-restricted operational workflows. In the KazUTB Digital Library repository, this coexistence is visible through public routes, protected operations, integration boundaries, and circulation/reservation logic.

Repository evidence from phase1 established a non-uniform risk profile, with higher-priority concerns around authentication/session behavior, catalog correctness, API authorization, circulation reliability, and coverage gaps. This context motivates a risk-based multi-layer QA approach in which testing depth is allocated where impact concentration is highest.

This paper frames the repository as an evolving empirical QA case study. The objective is to analyze how evidence quality changed from strategy-level planning to experiment-backed findings, and to provide a traceable claims governance model for research drafting in project-based software QA.

[figure reference placeholder: F1]

## Literature Review

The draft literature frame covers risk-based testing, layered QA strategy, CI/CD quality gates, mutation testing, performance testing, chaos/resilience testing, and empirical case-study methodology. External sources are intentionally not fabricated and are marked for integration.

Risk-based testing principles [citation needed] [external reference required] align with the phase1 prioritization model. Layered QA and governance framing [citation needed] [external reference required] align with phase2 automation and gate controls. Mutation/performance/chaos methodological interpretation also requires formal reference grounding [citation needed] [external reference required].

Empirical software engineering case-study standards for validity and reproducibility are likewise required for final publication-grade framing [citation needed] [external reference required].

## Methodology

The methodology follows an evolving empirical pipeline:

1. phase1 established risk-ranked scope and baseline evidence rules,
2. phase2 operationalized automation and quality-gate governance,
3. midterm reassessed assumptions with observed metrics,
4. phase3 added experimental performance/mutation/chaos evidence.

Evidence collection was artifact-driven (CSV/JSON metrics, traceability files, reports, mapped figures). Selection remained risk-prioritized, with repeated attention to high-impact module clusters. CI/CD gate outputs were treated as governance evidence, not as sole quality proxies.

Bounded-scope constraints were explicitly disclosed, especially for local/sequential performance and bounded synthetic chaos models.

[figure reference placeholder: F7]
[table reference placeholder: T1]

## Results

Phase2 results show weighted high-risk automation coverage of 75.0%, 9 observed defects/issues, and gate distribution pass=5/fail=3/warn=1. Midterm results preserved 75.0% weighted checks, reported 8/8 newly added tests passed, and retained evidence of concentrated risk.

Phase3 results added experimental depth: performance scenarios passed 8/9 with one integration-boundary failure, mutation score reached 85.71% with two survivors, and chaos metrics showed 100.00% recovery availability under bounded synthetic faults with zero observed cascading failures.

Cross-phase summary artifacts provide a phase-level progression indicator used for synthesis.

[figure reference placeholder: F2]
[figure reference placeholder: F3]
[figure reference placeholder: F4]
[figure reference placeholder: F5]
[figure reference placeholder: F6]
[figure reference placeholder: F7]
[table reference placeholder: T2]

## Discussion

The evidence supports the practical utility of risk-first planning when paired with iterative reassessment and experimental validation. It also shows that automation presence and governance controls alone do not eliminate high-impact risk concentration.

Experiments in phase3 provided diagnostic value beyond basic automation status by exposing latency concentration, assertion-sensitivity gaps, and bounded recovery behavior characteristics. Integration-boundary persistence across phases remains the strongest unresolved empirical signal.

Threats to validity include bounded synthetic execution contexts, environment-specific timing behavior, incomplete repeated-run stability evidence, and blocked early-phase metrics.

[citation needed] [external reference required]

[table reference placeholder: T3]

## Preliminary Conclusions

The repository demonstrates measurable QA process maturation across phases, with improved evidence depth and stronger claim discipline. However, the same evidence base indicates that integration-focused risk remains non-trivial and should be treated as an active concern rather than a resolved finding.

## Final Insight

The strongest insight is that QA maturity in this case emerged from consistency across risk priorities, governance outcomes, and experimental findings over time, not from any single metric family.

[citation needed] [external reference required]

## Final Conclusion

This draft establishes a full, evidence-traceable research narrative from baseline risk strategy through experimental synthesis. It contributes a practical model for project-level QA research reporting and a claims-to-evidence governance mechanism that limits unsupported assertions.

Future work should complete external citation integration, refine final prose for academic publication standards, and expand production-like validation where bounded contexts limit external generalization.

## References

Internal evidence inventory:

- qa/phase4/references/source-inventory.md

External references:

- [citation needed]
- [external reference required]

## Appendices / Evidence Notes

1. Figure mapping: qa/paper-assets/figures/figure-index.md
2. Claims matrix: qa/phase4/paper/claims-to-evidence-matrix.md
3. Traceability: qa/phase4/TRACEABILITY.md
4. Chaos evidence references: qa/phase3/evidence/references/phase3-chaos-command-log.md

---

KazUTB Digital Library - Phase 4 Part 2
