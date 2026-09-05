# Accounting invariants

1. Every posted journal contains at least two lines and total debit equals total credit, greater than zero.
2. Each line has exactly one positive side: debit XOR credit.
3. Every account on a journal belongs to the journal company and is active/postable at posting time.
4. Drafts do not affect reports. Posted entries are immutable. Corrections are additive reversals.
5. Closed periods reject new posting. Reopening is explicit, privileged, reasoned and audited.
6. The authoritative balance is reconstructed from posted journal lines, never from a mutable account balance column.
7. Transaction exchange rates are frozen. Period-end revaluation posts incremental unrealized FX. Settlement posts realized FX against the current carrying amount.
8. Sales/purchase documents freeze the AR/AP control account used when posted; later settings changes do not alter historical settlement accounting.
9. Historical aging uses only credits, payments and voids effective on or before the report date.
10. Year-end closes revenue/expense accounts through a journal to retained earnings. The closing journal is excluded from historical P&L mechanics but remains part of the balance sheet ledger.
