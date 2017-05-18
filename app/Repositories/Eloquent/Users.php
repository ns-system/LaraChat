<?php
namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class EntryEntity
 * @package App\Repositories\Eloquent
 */
class Users extends Eloquent
{

    /** @var string  */
    protected $primaryKey = 'id';

    /** @var string  */
//    protected $table = 'entries';

    /** @var array  */
//    protected $fillable = [
//        'title',
//        'content'
//    ];
}