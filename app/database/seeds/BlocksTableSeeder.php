<?php

class BlocksTableSeeder extends Seeder {

    public function run()
    {
        DB::table('block_types')->delete();

        DB::table('block_types')->insert( array(
            array(
                'name'  => 'wysiwyg',
                'model'  => 'Wysiwyg',
                'icon'  => 'fa fa-font',
                'lang'  => 'admin.blocktype.wysiwyg',
                'path_to_view' => 'admin.page.block.wysiwyg',
                'multi' => false,
                'linked_on_module' => false,
            ),array(
                'name'  => 'form',
                'model'  => 'Formr',
                'icon'  => 'fa fa-list-ul',
                'lang'  => 'admin.blocktype.form',
                'path_to_view' => 'admin.page.block.form',
                'multi' => true,
                'linked_on_module' => false,
            )
        ));

        DB::table('blocks')->delete();

        DB::table('blocks')->insert( array(
            array(
                'blockable_id'  => 1,
                'blockable_type'=> 'BlockContent',
                'page_id'       => 1,
                'type_id'       => 1,
                'order'         => 0,
                'is_clearfixed' => true
            ),array(
                'blockable_id'  => 2,
                'blockable_type'=> 'BlockContent',
                'page_id'       => 1,
                'type_id'       => 1,
                'order'         => 1,
                'is_clearfixed' => false
            ),array(
                'blockable_id'  => 3,
                'blockable_type'=> 'BlockContent',
                'page_id'       => 1,
                'type_id'       => 1,
                'order'         => 2,
                'is_clearfixed' => false
            ),array(
                'blockable_id'  => 4,
                'blockable_type'=> 'BlockContent',
                'page_id'       => 1,
                'type_id'       => 1,
                'order'         => 3,
                'is_clearfixed' => true
            ),
            array(
                'blockable_id'  => 5,
                'blockable_type'=> 'BlockContent',
                'page_id'       => 2,
                'type_id'       => 1,
                'order'         => 0,
                'is_clearfixed' => true
            ),
            array(
                'blockable_id'  => 1,
                'blockable_type'=> 'Formr',
                'page_id'       => 2,
                'type_id'       => 2,
                'order'         => 1,
                'is_clearfixed' => true
            ))
        );
    }

}
