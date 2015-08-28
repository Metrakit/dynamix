<?php

class TasksTableSeeder extends Seeder {


    public function run()
    {

        DB::table('tasks')->insert( array(
            array(
                'id'    => 1,
                'label'    => 'module dynamix',
                'description'    => 'developpement d\'un module pour dynamix',
                'date'    => new DateTime('2015-01-29'),
                ),
            array(
                'id'    => 2,
                'label'    => 'chybrage',
                'description'    => 'chybrage de la demoiselle',
                'date'    => new DateTime('2015-01-21'),
                ),
            array(
                'id'    => 3,
                'label'    => 'bisous bisous',
                'description'    => 'plein de bisous a tout le monde',
                'date'    => new DateTime('2015-02-15'),
                ),
            )
        );

        DB::table('labels')->insert( array(
            array(
                'label'    => 'low priority',
                'color'    => 'yellow',
                ),
            array(
                'label'    => 'medium priority',
                'color'    => 'orange',
                ),
            array(
                'label'    => 'high priority',
                'color'    => 'red',
                ),
            )
        );
        DB::table('label_task')->insert( array(
            array(
                'tasks_id'    => 1,
                'labels_id'    => 3,
                ),
            array(
                'tasks_id'    => 1,
                'labels_id'    => 2,
                ),
            array(
                'tasks_id'    => 2,
                'labels_id'    => 1,
                ),
            array(
                'tasks_id'    => 2,
                'labels_id'    => 2,
                ),
            )
        );
    }

}
