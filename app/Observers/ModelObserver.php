<?php

namespace App\Observers;

use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;

class ModelObserver
{
    /**
     * Event handling after a model is created
     *
     * @param  mixed  $model
     * @return void
     */
    public function created($model)
    {
        activity()
            ->performedOn($model)
            ->causedBy(Auth::user())
            ->withProperties([
                'model_type' => get_class($model),
                'attributes' => $model->getAttributes()
            ])
            ->log('Tạo mới');
    }

    /**
     * Event handling after a model is updated
     *
     * @param  mixed  $model
     * @return void
     */
    public function updated($model)
    {
        $changes = $model->getChanges();
        $original = $model->getOriginal();

        if (!empty($changes)) {
            activity()
                ->performedOn($model)
                ->causedBy(Auth::user())
                ->withProperties([
                    'model_type' => get_class($model),
                    'old_values' => array_intersect_key($original, $changes),
                    'new_values' => $changes
                ])
                ->log('Cập nhật');
        }
    }

    /**
     * Event handling before a model is deleted
     *
     * @param  mixed  $model
     * @return void
     */
    public function deleting($model)
    {
        activity()
            ->performedOn($model)
            ->causedBy(Auth::user())
            ->withProperties([
                'model_type' => get_class($model),
                'model_id' => $model->id,
                'attributes' => $model->getAttributes()
            ])
            ->log('Xóa');
    }

    /**
     * Event handling after a model is restored (for soft deletes)
     *
     * @param  mixed  $model
     * @return void
     */
    public function restored($model)
    {
        activity()
            ->performedOn($model)
            ->causedBy(Auth::user())
            ->withProperties([
                'model_type' => get_class($model),
                'model_id' => $model->id,
                'attributes' => $model->getAttributes()
            ])
            ->log('Khôi phục');
    }

    /**
     * Event handling after a model is force deleted
     *
     * @param  mixed  $model
     * @return void
     */
    public function forceDeleted($model)
    {
        activity()
            ->performedOn($model)
            ->causedBy(Auth::user())
            ->withProperties([
                'model_type' => get_class($model),
                'model_id' => $model->id,
                'attributes' => $model->getOriginal()
            ])
            ->log('Xóa vĩnh viễn');
    }
}