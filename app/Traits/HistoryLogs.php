<?php
namespace App\Traits;

use App\Models\HistoryLogs as HistoryLogsModel;
use Illuminate\Support\Facades\Log;

trait HistoryLogs
{
    /**
     * 透過此方法
     *
     * @param array $operations
     * @return void
     */
    public static function saveHistory(array $operations = ['created', 'updated', 'deleted'])
    {
        // $user = auth('admin')->user();
        // if (null !== $user) {
            foreach ($operations as $operation) {
                // forward_static_call([__CLASS__, $operation], function($model) use ($user, $operation) {
                forward_static_call([__CLASS__, $operation], function($model) use ($operation) {
                    $isNotCreate = in_array($operation, ['updated', 'deleted']);
                    // 如果沒有唯一鍵值的話就不記錄, 然後額外 log 起來
                    if (null === $model->primaryKey) {
                        Log::error(print_r([
                            'title' => 'model_id 需要填入唯一鍵值, 但 model 沒有',
                            'operation' => $operation,
                            'operation_user_id' => 1, //$user->id,
                            'model' => get_class($model),
                            'attributes' => json_encode($model->attributes),
                            'before' => $isNotCreate ? json_encode($model->original) : null,
                            'after' => $isNotCreate ? json_encode($model->attributes) : null,
                        ], true));
                    } else {
                        $history = new HistoryLogsModel();
                        $history->model = get_class($model);
                        $history->model_id = $model->{$model->primaryKey};
                        $history->user_id = 1; // $user->id;
                        $history->operation = $operation;
                        $history->before = $isNotCreate ? json_encode($model->original) : null;
                        $history->after = $isNotCreate ? json_encode($model->attributes) : null;
                        $history->changes_info = $isNotCreate ? json_encode($model->changes) : null;
                        $history->save();
                    }
                });
            }
        // }
    }


    public function histories()
    {
        return $this->hasMany(HistoryLogsModel::class, 'model_id', 'id')
            ->where('model', __CLASS__);
    }
}
