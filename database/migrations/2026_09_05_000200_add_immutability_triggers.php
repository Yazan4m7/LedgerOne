<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
return new class extends Migration {
 public function up(): void {
  $d=DB::getDriverName();
  if($d==='sqlite'){
   DB::unprepared("CREATE TRIGGER journals_no_update_posted BEFORE UPDATE OF company_id,accounting_period_id,journal_number,entry_date,description,source_type,source_id,exclude_from_profit_loss,reversal_of_journal_id,created_by,posted_by,posted_at ON journals WHEN OLD.status <> 'draft' BEGIN SELECT RAISE(ABORT,'posted journals are immutable'); END;");
   DB::unprepared("CREATE TRIGGER journals_status_transition BEFORE UPDATE OF status ON journals WHEN (OLD.status='posted' AND NEW.status NOT IN ('posted','reversed')) OR (OLD.status='reversed' AND NEW.status <> 'reversed') BEGIN SELECT RAISE(ABORT,'invalid journal status transition'); END;");
   DB::unprepared("CREATE TRIGGER journals_no_delete_posted BEFORE DELETE ON journals WHEN OLD.status <> 'draft' BEGIN SELECT RAISE(ABORT,'posted journals are immutable'); END;");
   DB::unprepared("CREATE TRIGGER journal_lines_no_update_posted BEFORE UPDATE ON journal_lines WHEN (SELECT status FROM journals WHERE id=OLD.journal_id) <> 'draft' BEGIN SELECT RAISE(ABORT,'posted journal lines are immutable'); END;");
   DB::unprepared("CREATE TRIGGER journal_lines_no_delete_posted BEFORE DELETE ON journal_lines WHEN (SELECT status FROM journals WHERE id=OLD.journal_id) <> 'draft' BEGIN SELECT RAISE(ABORT,'posted journal lines are immutable'); END;");
   return;
  }
  if($d==='mysql'){
   DB::unprepared("CREATE TRIGGER journals_no_update_posted BEFORE UPDATE ON journals FOR EACH ROW BEGIN IF OLD.status <> 'draft' AND (NOT (NEW.company_id <=> OLD.company_id) OR NOT (NEW.accounting_period_id <=> OLD.accounting_period_id) OR NOT (NEW.journal_number <=> OLD.journal_number) OR NOT (NEW.entry_date <=> OLD.entry_date) OR NOT (NEW.description <=> OLD.description) OR NOT (NEW.source_type <=> OLD.source_type) OR NOT (NEW.source_id <=> OLD.source_id) OR NOT (NEW.exclude_from_profit_loss <=> OLD.exclude_from_profit_loss) OR NOT (NEW.reversal_of_journal_id <=> OLD.reversal_of_journal_id) OR NOT (NEW.created_by <=> OLD.created_by) OR NOT (NEW.posted_by <=> OLD.posted_by) OR NOT (NEW.posted_at <=> OLD.posted_at)) THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='posted journals are immutable'; END IF; IF OLD.status='posted' AND NEW.status NOT IN ('posted','reversed') THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='invalid journal status transition'; END IF; IF OLD.status='reversed' AND NEW.status <> 'reversed' THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='invalid journal status transition'; END IF; END");
   DB::unprepared("CREATE TRIGGER journals_no_delete_posted BEFORE DELETE ON journals FOR EACH ROW BEGIN IF OLD.status <> 'draft' THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='posted journals are immutable'; END IF; END");
   DB::unprepared("CREATE TRIGGER journal_lines_no_update_posted BEFORE UPDATE ON journal_lines FOR EACH ROW BEGIN IF (SELECT status FROM journals WHERE id=OLD.journal_id) <> 'draft' THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='posted journal lines are immutable'; END IF; END");
   DB::unprepared("CREATE TRIGGER journal_lines_no_delete_posted BEFORE DELETE ON journal_lines FOR EACH ROW BEGIN IF (SELECT status FROM journals WHERE id=OLD.journal_id) <> 'draft' THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='posted journal lines are immutable'; END IF; END");
  }
 }
 public function down(): void {foreach(['journals_no_update_posted','journals_status_transition','journals_no_delete_posted','journal_lines_no_update_posted','journal_lines_no_delete_posted'] as $x) DB::unprepared('DROP TRIGGER IF EXISTS '.$x);}
};