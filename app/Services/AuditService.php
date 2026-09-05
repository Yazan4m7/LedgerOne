<?php
namespace App\Services;
use App\Models\AuditLog;
class AuditService {public function record(string $event, object|null $model=null, array|null $before=null,array|null $after=null,?int $companyId=null,?int $userId=null): AuditLog {return AuditLog::create(['company_id'=>$companyId??($model->company_id??auth()->user()?->company_id),'user_id'=>$userId??auth()->id(),'event'=>$event,'auditable_type'=>$model?get_class($model):null,'auditable_id'=>$model->id??null,'before'=>$before,'after'=>$after,'ip_address'=>request()?->ip(),'user_agent'=>request()?->userAgent()]);}}
