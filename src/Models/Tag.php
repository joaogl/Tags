<?php namespace jlourenco\tags\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use DB;

class Tag extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Tag';

    /**
     * To allow soft deletes
     */
    use SoftDeletes;

    public static function getMostActiveTags()
    {
        /*
        SELECT T.name, COUNT(*) 'count'
        FROM Project_Tag PT
        INNER JOIN Tag T ON T.ID = PT.tag
        GROUP BY tag ORDER BY 'count'
        LIMIT 5
        */

        $colors = [ '#005391', '#B7CA0F', '#394900', '#8ACCF5', '#8F1828', '#5E9A1D', '#D6B329', '#FD5E1E' ];

        $data = [];
        $results = DB::select(DB::raw('SELECT T.name, COUNT(*) \'count\' FROM Project_Tag PT INNER JOIN Tag T ON T.ID = PT.tag GROUP BY tag ORDER BY \'count\' LIMIT 8'));

        foreach ($results as $result)
        {
            $obj = [
                'value'=> $result->count,
                'color'=> $colors[sizeof($data)],
                'highlight'=> \jlourenco\base\Helpers\ColorHelper::adjustBrightness($colors[sizeof($data)], 20),
                'label'=> $result->name
            ];
            $data[sizeof($data)] = $obj;
        }

        return $data;
    }

}
