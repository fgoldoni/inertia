<?php
namespace Modules\Teams\Services;

use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\WithTrashed;
use App\Services\ServiceAbstract;
use Illuminate\Support\Collection;
use Modules\Teams\Enums\ColorType;
use Modules\Teams\Repositories\Contracts\TeamsRepository;
use Modules\Teams\Services\Contracts\TeamsServiceInterface;
use Modules\Teams\Transformers\TeamResource;

/**
 * Class TeamsService.
 */
class TeamsService extends ServiceAbstract implements TeamsServiceInterface
{
    protected function repository(): string
    {
        return TeamsRepository::class;
    }

    public function findTeam(int $id): TeamResource
    {
        return new TeamResource($this->repository->withCriteria([
            new EagerLoad([
                'owner:id,name,email,profile_photo_path',
                'users:id,name,email',
                'activities',
                'categories:id,name,type',
                'teamInvitations',
                'attachments' => function ($query) {
                    $query->select([
                        'id',
                        'name',
                        'filename',
                        'disk',
                        'attachable_id',
                        'attachable_type'
                    ])->where('attachments.disk', config('app.system.disks.uploads'));
                }
            ]),
            new WithTrashed(),
        ])->find($id));
    }

    public function allOptionsTeams()
    {
        if (auth()->user()->isAdministrator()) {
            return $this->repository->withCriteria([
                new WithTrashed(),
            ])->get(['id', 'name', 'display_name']);
        } else {
            return auth()->user()->allTeams()->map(fn ($item) => [
                'id' => $item->id,
                'name' => $item->name,
                'display_name' => $item->display_name,
            ]);
        }
    }

    public function colors(): Collection
    {
        $pink = (ColorType::Pink)->value;

        $purple = (ColorType::Purple)->value;

        $blue = (ColorType::Blue)->value;

        $green = (ColorType::Green)->value;

        $cyan = (ColorType::Cyan)->value;

        $yellow = (ColorType::Yellow)->value;

        $teal = (ColorType::Teal)->value;

        $indigo = (ColorType::Indigo)->value;

        $red = (ColorType::Red)->value;

        $amber = (ColorType::Amber)->value;

        $lime = (ColorType::Lime)->value;

        $rose = (ColorType::Rose)->value;

        $slate = (ColorType::Slate)->value;

        $fuchsia = (ColorType::Fuchsia)->value;

        $stone = (ColorType::Stone)->value;

        $violet = (ColorType::Violet)->value;

        return collect([
            [
                'id' => $pink,
                'name' => ucfirst($pink),
                'bgColor' => "bg-$pink-500",
                'selectedColor' => "ring-$pink-500",
            ],
            [
                'id' => $purple,
                'name' => ucfirst($purple),
                'bgColor' => "bg-$purple-500",
                'selectedColor' => "ring-$purple-500",
            ],
            [
                'id' => $blue,
                'name' => ucfirst($blue),
                'bgColor' => "bg-$blue-500",
                'selectedColor' => "ring-$blue-500",
            ],
            [
                'id' => $green,
                'name' => ucfirst($green),
                'bgColor' => "bg-$green-500",
                'selectedColor' => "ring-$green-500",
            ],
            [
                'id' => $cyan,
                'name' => ucfirst($cyan),
                'bgColor' => "bg-$cyan-500",
                'selectedColor' => "ring-$cyan-500",
            ],
            [
                'id' => $yellow,
                'name' => ucfirst($yellow),
                'bgColor' => "bg-$yellow-500",
                'selectedColor' => "ring-$yellow-500",
            ],
            [
                'id' => $teal,
                'name' => ucfirst($teal),
                'bgColor' => "bg-$teal-500",
                'selectedColor' => "ring-$teal-500",
            ],
            [
                'id' => $indigo,
                'name' => ucfirst($indigo),
                'bgColor' => "bg-$indigo-500",
                'selectedColor' => "ring-$indigo-500",
            ],

            [
                'id' => $red,
                'name' => ucfirst($red),
                'bgColor' => "bg-$red-500",
                'selectedColor' => "ring-$red-500",
            ],
            [
                'id' => $amber,
                'name' => ucfirst($amber),
                'bgColor' => "bg-$amber-500",
                'selectedColor' => "ring-$amber-500",
            ],
            [
                'id' => $lime,
                'name' => ucfirst($lime),
                'bgColor' => "bg-$lime-500",
                'selectedColor' => "ring-$lime-500",
            ],
            [
                'id' => $rose,
                'name' => ucfirst($rose),
                'bgColor' => "bg-$rose-500",
                'selectedColor' => "ring-$rose-500",
            ],
            [
                'id' => $slate,
                'name' => ucfirst($slate),
                'bgColor' => "bg-$slate-500",
                'selectedColor' => "ring-$slate-500",
            ],
            [
                'id' => $fuchsia,
                'name' => ucfirst($fuchsia),
                'bgColor' => "bg-$fuchsia-500",
                'selectedColor' => "ring-$fuchsia-500",
            ],
            [
                'id' => $stone,
                'name' => ucfirst($stone),
                'bgColor' => "bg-$stone-500",
                'selectedColor' => "ring-$stone-500",
            ],
            [
                'id' => $violet,
                'name' => ucfirst($violet),
                'bgColor' => "bg-$violet-500",
                'selectedColor' => "ring-$violet-500",
            ],
        ]);
    }
}
