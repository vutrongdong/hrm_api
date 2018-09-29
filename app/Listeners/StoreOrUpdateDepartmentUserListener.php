<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Repositories\Departments\DepartmentRepository;
use App\Events\StoreOrUpdateDepartmentUserEvent;

class StoreOrUpdateDepartmentUserListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(DepartmentRepository $departmentRepo)
    {
        $this->department = $departmentRepo;
    }

    /**
     * Handle the event.
     *
     * @param  ExampleEvent  $event
     * @return void
     */

    /**
     * store to department_user table
     * @param  User   $user [description]
     * @param  array  $data [department_id, position_id, status]
     * @return [type]       [description]
     */
    public function handle(StoreOrUpdateDepartmentUserEvent $event)
    {
        /*department_user
        [
            user_id,
            department_id,
            position_id,
            status
        ]
        =>
        [department_id => ['position_id' => '', 'status' => '']]*/
        $insertData = [];
        foreach ($event->departments as $key => $value) {
            $insertData[$value['department_id']] = [
                'position_id' => $value['position_id'],
                'status' => array_get($event->departments, $key.'.status', 0)
            ];
        }
        $event->user->departments()->sync($insertData);
    }
}
