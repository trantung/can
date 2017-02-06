<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class CategoryNestedset extends Eloquent
{
    use SoftDeletingTrait;
    use \Codefocus\NestedSet\NestedSetTrait;
    use \Devfactory\Taxonomy\TaxonomyTrait;
     protected $nestedSetColumns = [
    //  Which column to use for the "left" value.
    //  Default: left
        'left' => 'left',

    //  Which column to use for the "right" value.
    //  Default: right
        'right' => 'right',

    //  Which column to point to the parent's PK.
    //  Null is allowed. This will remove the ability to rebuild the tree.
    //  Default: parent_id
        'parent' => 'parent_id',

    //  Which column to use for the node's "depth", or level in the tree.
    //  Null is allowed.
    //    ! When restricting the tree by depth, each node's depth will be
    //      calculated automatically. This is not recommended for large trees.
    //  Default: null
        'depth' => null,

    //  When a table can hold multiple trees, we need to specify which field
    //  uniquely identifies which tree we are operating on.
    //  E.g. in the case of comments, that could be "thread_id" or "post_id".
    //  Null is allowed. NestedSetTrait will assume there is only one tree.
    //  Default: null
        'group' => null,
    ];

    protected $table = 'companny';
    protected $fillable = ['name', 'address', 'company_id', 'created_by', 'updated_by'];

}