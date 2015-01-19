<?php

class CommentsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('comments')->delete();
        DB::table('comments')->insert( array(
            array(
                'text'     => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi pulvinar, augue eget accumsan dignissim, turpis turpis dictum elit, nec dapibus enim mi a tellus. Quisque blandit tincidunt mattis. Fusce non erat eget augue vehicula sodales sed vel dui. Pellentesque a dolor at erat auctor tempor et fringilla tortor.',
                'user_id'  => 1,
                'locale_id' => null,
                'commentable_id'  => 1,
                'commentable_type'  => 'Page',

                'created_at' => new DateTime,
                'updated_at' => new DateTime
                ),
            array(
                'text'     => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi pulvinar, augue eget accumsan dignissim, turpis turpis dictum elit, nec dapibus enim mi a tellus. Quisque blandit tincidunt mattis. Fusce non erat eget augue vehicula sodales sed vel dui. Pellentesque a dolor at erat auctor tempor et fringilla tortor.',
                'user_id'  => 1,
                'locale_id' => null,
                'commentable_id'  => 1,
                'commentable_type'  => 'Page',

                'created_at' => new DateTime,
                'updated_at' => new DateTime
                ),
            array(
                'text'     => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi pulvinar, augue eget accumsan dignissim, turpis turpis dictum elit, nec dapibus enim mi a tellus. Quisque blandit tincidunt mattis. Fusce non erat eget augue vehicula sodales sed vel dui. Pellentesque a dolor at erat auctor tempor et fringilla tortor.',
                'user_id'  => 1,
                'locale_id' => null,
                'commentable_id'  => 1,
                'commentable_type'  => 'Comment',

                'created_at' => new DateTime,
                'updated_at' => new DateTime
                ),
            array(
                'text'     => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi pulvinar, augue eget accumsan dignissim, turpis turpis dictum elit, nec dapibus enim mi a tellus. Quisque blandit tincidunt mattis. Fusce non erat eget augue vehicula sodales sed vel dui. Pellentesque a dolor at erat auctor tempor et fringilla tortor.',
                'user_id'  => 1,
                'locale_id' => null,
                'commentable_id'  => 3,
                'commentable_type'  => 'Comment',

                'created_at' => new DateTime,
                'updated_at' => new DateTime
                ))
        );

        DB::table('comment_votes')->delete();
        DB::table('comment_votes')->insert( array(
            array(
                'user_id'     => 1,
                'comment_id'  => 1,
                'is_positive'  => 1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
                ),
            array(
                'user_id'     => 1,
                'comment_id'  => 1,
                'is_positive'  => 1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
                ),
            array(
                'user_id'     => 1,
                'comment_id'  => 1,
                'is_positive'  => 1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
                ),
            array(
                'user_id'     => 1,
                'comment_id'  => 1,
                'is_positive'  => 1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
                ),
            array(
                'user_id'     => 1,
                'comment_id'  => 1,
                'is_positive'  => 1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
                ))
        );
    }

}