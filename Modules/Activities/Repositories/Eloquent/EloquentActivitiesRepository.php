<?php

/**
 * Created by PhpStorm.
 * User: emere
 * Date: 09/10/2018
 * Time: 11:40.
 */

namespace Modules\Activities\Repositories\Eloquent;

use App\Repositories\RepositoryAbstract;
use Illuminate\Support\Carbon;
use Modules\Activities\Repositories\Contracts\ActivitiesRepository;
use Spatie\Activitylog\Models\Activity;

/**
 * Class EloquentActivitiesRepository.
 */
class EloquentActivitiesRepository extends RepositoryAbstract implements ActivitiesRepository
{
    public function model()
    {
        return Activity::class;
    }

    /**
     * @param $subject
     */
    public function byModel($subject): array
    {
        $items = [];

        foreach ($subject->activities()->latest()->get() as $activity) {
            $item['properties'] = $this->loadProperties($activity->properties);

            if (! empty($item['properties']) && $activity->causer_id && $activity->causer()->first()) {
                $causer = $activity->causer()->first();
                $item['description'] = $activity->description;
                $item['causer'] = is_null($activity->causer_id)
                    ? 'System' : (($causer) ? $causer->name : 'Not existing causer '.$activity->causer_id);
                $item['updated_at'] = $activity->updated_at;
                $item['created_at'] = Carbon::parse($activity->created_at)->format('d, M Y H:i');
                $items[] = $item;
            }
        }

        return $items;
    }

    private function loadProperties($properties)
    {
        $items = [];
        $old = $properties->get('old');
        $attributes = $properties->get('attributes');
        if (isset($attributes)) {
            if (isset($old)) {
                foreach ($attributes as $key => $property) {
                    if (0 !== mb_strlen((string) $property) || 0 !== mb_strlen((string) $old[$key])) {
                        $items[$key] = "<s>{$old[$key]}</s>  {$property}";
                    }
                }
            } else {
                foreach ($attributes as $key => $property) {
                    if (\is_string($property)) {
                        $items[$key] = $property;
                    }
                }
            }
        } else {
            foreach ($properties as $key => $property) {
                if (\is_string($property)) {
                    $items[$key] = $property;
                }
            }
        }

        return $items;
    }
}
