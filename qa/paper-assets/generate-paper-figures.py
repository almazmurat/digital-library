import json
from pathlib import Path

import matplotlib.pyplot as plt
import pandas as pd

ROOT = Path(__file__).resolve().parents[1]
PAPER = ROOT / "paper-assets"
FIG = PAPER / "figures"


def ensure_parent(path: Path) -> None:
    path.parent.mkdir(parents=True, exist_ok=True)


def save_fig(path: Path) -> None:
    ensure_parent(path)
    plt.tight_layout()
    plt.savefig(path, dpi=300)
    plt.close()


# Figure 1: baseline QA layer (Phase 1) manual vs automated test inventory
phase1 = pd.read_csv(ROOT / "phase1" / "metrics" / "phase1-baseline-metrics.csv")
manual = float(phase1.loc[phase1["Metric"] == "baseline QA layer (Phase 1) manual test case files (total)", "Value"].iloc[0])
unit_tests = float(phase1.loc[phase1["Metric"] == "Repository tests (unit)", "Value"].iloc[0])
feature_tests = float(phase1.loc[phase1["Metric"] == "Repository tests (feature)", "Value"].iloc[0])
e2e_tests = float(phase1.loc[phase1["Metric"] == "Repository tests (e2e)", "Value"].iloc[0])
automated_total = unit_tests + feature_tests + e2e_tests

plt.figure(figsize=(8, 5))
plt.bar(["Manual test files", "Automated test files"], [manual, automated_total], color=["#6c757d", "#0d6efd"])
plt.title("baseline QA layer (Phase 1) Test Inventory: Manual vs Automated")
plt.ylabel("Count")
save_fig(FIG / "phase1" / "phase1_manual_vs_automated_inventory.png")


# Figure 2: automation and CI governance layer (Phase 2) automation coverage by module
phase2_cov = pd.read_csv(ROOT / "phase2" / "metrics" / "phase2-automation-coverage.csv")
plt.figure(figsize=(10, 5))
plt.bar(phase2_cov["module_feature"], phase2_cov["coverage_percent"].astype(float), color="#198754")
plt.xticks(rotation=30, ha="right")
plt.ylim(0, 100)
plt.title("automation and CI governance layer (Phase 2) Automation Coverage by Module")
plt.ylabel("Coverage (%)")
save_fig(FIG / "phase2" / "phase2_automation_coverage_by_module.png")


# Figure 3: Intermediate Empirical Review defects vs risk (planned vs actual risk)
mid_risk = pd.read_csv(ROOT / "Intermediate Empirical Review" / "charts" / "midterm-planned-vs-actual-chart.csv")
idx = range(len(mid_risk))
plt.figure(figsize=(10, 5))
width = 0.4
plt.bar([i - width / 2 for i in idx], mid_risk["planned_risk_score"].astype(float), width=width, label="Planned risk")
plt.bar([i + width / 2 for i in idx], mid_risk["actual_risk_score"].astype(float), width=width, label="Observed risk")
plt.xticks(list(idx), mid_risk["aspect"], rotation=20, ha="right")
plt.title("Intermediate Empirical Review Planned vs Observed Risk")
plt.ylabel("Risk score")
plt.legend()
save_fig(FIG / "Intermediate Empirical Review" / "midterm_defects_vs_risk.png")


# Figure 4: experimental evaluation layer (Phase 3) performance response times
perf = pd.read_csv(ROOT / "phase3" / "charts" / "phase3-response-time-chart.csv")
plt.figure(figsize=(11, 5))
plt.plot(perf["scenario_id"], perf["avg_ms"], marker="o", label="Average")
plt.plot(perf["scenario_id"], perf["p95_ms"], marker="o", label="P95")
plt.xticks(rotation=35, ha="right")
plt.title("experimental evaluation layer (Phase 3) Performance Response Times")
plt.ylabel("Latency (ms)")
plt.legend()
save_fig(FIG / "phase3" / "phase3_performance_response_times.png")


# Figure 5: experimental evaluation layer (Phase 3) mutation score by module
mut = pd.read_csv(ROOT / "phase3" / "charts" / "phase3-mutation-score-chart.csv")
plt.figure(figsize=(9, 5))
plt.bar(mut["module"], mut["mutation_score_pct"].astype(float), color="#6610f2")
plt.xticks(rotation=25, ha="right")
plt.ylim(0, 100)
plt.title("experimental evaluation layer (Phase 3) Mutation Score by Module")
plt.ylabel("Mutation score (%)")
save_fig(FIG / "phase3" / "phase3_mutation_score_by_module.png")


# Figure 6: experimental evaluation layer (Phase 3) chaos availability by scenario
chaos_av = pd.read_csv(ROOT / "phase3" / "charts" / "phase3-chaos-availability-chart.csv")
idx = range(len(chaos_av))
plt.figure(figsize=(10, 5))
width = 0.4
plt.bar([i - width / 2 for i in idx], chaos_av["fault_availability_pct"].astype(float), width=width, label="Fault phase")
plt.bar([i + width / 2 for i in idx], chaos_av["recovery_availability_pct"].astype(float), width=width, label="Recovery phase")
plt.xticks(list(idx), chaos_av["scenario_id"], rotation=20, ha="right")
plt.ylim(0, 100)
plt.title("experimental evaluation layer (Phase 3) Chaos Availability by Scenario")
plt.ylabel("Availability (%)")
plt.legend()
save_fig(FIG / "phase3" / "phase3_chaos_availability_by_scenario.png")


# Figure 7: Summary quality progression across phases (phase-specific indicator values)
phase2_avg_cov = round(phase2_cov["coverage_percent"].astype(float).mean(), 2)
midterm_qg = pd.read_csv(ROOT / "Intermediate Empirical Review" / "metrics" / "midterm-quality-gate-evaluation.csv")
qg_pass = (midterm_qg["status"] == "Pass").sum()
qg_fail = (midterm_qg["status"] == "Fail").sum()
midterm_gate_pass_pct = round((qg_pass / (qg_pass + qg_fail)) * 100, 2)
phase3_perf = pd.read_csv(ROOT / "phase3" / "metrics" / "phase3-performance-results.csv")
phase3_perf_pass_pct = round((phase3_perf["scenario_passed"].astype(str).str.upper().eq("TRUE").sum() / len(phase3_perf)) * 100, 2)
phase3_mut = pd.read_csv(ROOT / "phase3" / "metrics" / "phase3-mutation-score.csv")
phase3_mut_overall = float(phase3_mut.loc[phase3_mut["module"] == "Overall", "mutation_score_pct"].iloc[0])
phase3_chaos = pd.read_csv(ROOT / "phase3" / "metrics" / "phase3-chaos-metrics.csv")
phase3_chaos_recovery = float(phase3_chaos.loc[phase3_chaos["metric"] == "overall_recovery_phase_availability", "value"].iloc[0])
phase3_integrated = round((phase3_perf_pass_pct + phase3_mut_overall + phase3_chaos_recovery) / 3, 2)
phase1_indicator = round((automated_total / (automated_total + manual)) * 100, 2)

summary_df = pd.DataFrame(
    {
        "phase": ["baseline QA layer (Phase 1)", "automation and CI governance layer (Phase 2)", "Intermediate Empirical Review", "experimental evaluation layer (Phase 3)"],
        "indicator_pct": [phase1_indicator, phase2_avg_cov, midterm_gate_pass_pct, phase3_integrated],
    }
)
summary_df.to_csv(PAPER / "figures" / "summary" / "summary_quality_progression_source.csv", index=False)

plt.figure(figsize=(8, 5))
plt.plot(summary_df["phase"], summary_df["indicator_pct"], marker="o", linewidth=2, color="#dc3545")
plt.ylim(0, 100)
plt.title("Summary Quality Progression Across Phases")
plt.ylabel("Phase-specific quality indicator (%)")
save_fig(FIG / "summary" / "summary_quality_progression_across_phases.png")

print("Paper figures generated successfully.")
