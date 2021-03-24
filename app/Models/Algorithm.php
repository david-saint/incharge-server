<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Algorithm extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'text', 'actionType', 'positive', 'negative', 'onPositive',
        'onNegative', 'nextMove', 'tempPlan', 'delay', 'series', 'active',
        'conditionalFactor', 'conditionalOperator', 'conditionalValue', 'stateValue', 'label', 'progestogenPossible', 'progestogenPossibleDir', 'tempPlanDirN', 'tempPlanDirP'
    ];
}
