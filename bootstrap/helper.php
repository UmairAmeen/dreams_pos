<?php

function uppercase($string){
	return strtoupper($string);
}

// this function replace permission array "on" parameter with "true"
function permissions_filter(array $permission)
{
	foreach ($permission as $key => $value) {
		$permissions  = str_replace($value, 'true', $permission);
	}

	return json_encode($permissions);
}
// this function  all permission names
function permission_name($permission){
	$permission = json_decode($permission);
	$permission = collect($permission);
	$name = array();
	foreach ($permission as $key => $value) {
	$name[] = $key;
 	}

 	return $name;
}

// this function return user role id please check user edit form..!!!
function role_name($user)
{
	$ids = array_pluck($user->role,'id');
	return $ids;
}

function check_class($check)
{
	if($check == 1)
	{
		$class = 'success';
	
	}
	else
	{
		$class = 'danger';
	
	}

	return $class;
}

function check_status($check)
{
	if($check == 1)
	{
		
		$status = 'Active';
	}
	else
	{
	
		$status = 'In-Active';
	}

	return $status;
}

function numberformat($number)
{
	return 'Rs'.' '. number_format($number);
}
function processJsonFilters($query, $request, $replacement=[])
{
    // dd($replacement);
    if ($request->has('filter'))
    {
        eval('$filters = '.$request->filter.';');
        if (!is_array($filters))
        {
            $filters = [];
        }
        
        $filters = (array_flatten($filters));

        //i == column
        //i+1 == operation
        //i+2 == value
        //i+3 == next iteration and/OR
        foreach($replacement as $needle => $replace)
        {
            // dd($replacement['PENDING']);
            $filters = array_map(function ($v) use ($needle, $replace) {
                return $v == $needle ? (String)$replace : $v;
            }, $filters);
        }
        $new_filter = [];
        // $default = "and";
        $previous_iteration = null;
        for($i=0;$i<count($filters);$i++)
        {
            switch($filters[$i+1])
            {
                case 'contains':
                    $filters[$i+1] = 'LIKE';
                    $filters[$i+2] = '%'.$filters[$i+2].'%';
                break;
                case 'notcontains':
                    $filters[$i+1] = 'NOT LIKE';
                    $filters[$i+2] = '%'.$filters[$i+2].'%';
                break;

                case 'startswith':
                    $filters[$i+1] = 'LIKE';
                    $filters[$i+2] = $filters[$i+2].'%';
                break;

                case 'endswith':
                    $filters[$i+1] = 'LIKE';
                    $filters[$i+2] = '%'.$filters[$i+2];
                break;
            }

            $default = isset($filters[$i+3])?$filters[$i+3]:'and';

            // when apply more than one filter
            //i-1 == previous iteration and/OR
            if ($i>0)
            { 
                $previous_iteration = $filters[$i-1];
            }
            if($default =='or')
            {
                $new_filter[] = [$filters[$i], $filters[$i+1], $filters[$i+2]];
            }
            elseif($previous_iteration == 'or' && $default == 'and')
            {
                $new_filter[] = [$filters[$i], $filters[$i+1], $filters[$i+2]]; 
                $query->where(function($query) use ($new_filter) {
                    foreach($new_filter as $filter)
                    {
                        $query->orWhere($filter[0], $filter[1], $filter[2]);
                    }
                });
                $new_filter = [];
            }
            else{
                $query->where($filters[$i], $filters[$i+1], $filters[$i+2]);
            }
            
            $i = $i+3;
        }
    }
    if ($request->sort)
    {
        $sort = json_decode($request->sort);
        foreach($replacement as $needle => $replace)
        {
            if($needle == $sort[0]->selector)
            {
                $sort[0]->selector = $replace;
            }
        }
        $query = $query->orderBy($sort[0]->selector,$sort[0]->desc == 'true' ? 'desc' : 'asc');
    }

    if ($request->has('group'))
    {
        // Date Interval Grouping
        // Input [{"selector":"date","groupInterval":"year","isExpanded":true},{"selector":"date","groupInterval":"month","isExpanded":true},{"selector":"date","groupInterval":"day","isExpanded":false}]
        $group = json_decode($request->group);
        foreach($replacement as $needle => $replace)
        {
            if($needle == $group[0]->selector)
            {
                $group[0]->selector = $replace;
            }
        }
     
        $query = $query->select($group[0]->selector." as key2", \DB::raw("count(*) as count"))->groupBy($group[0]->selector)->get();
        $json = [];
        $date_data = [];
        if (isset($group[0]->groupInterval) &&  $group[0]->groupInterval== "year")
        {
            //map it like a hero
            foreach($query as $date)
            {
                $year_ky = date('Y', strtotime($date->key2));
                $month_ky = date('n', strtotime($date->key2));
                $day_ky = date('d', strtotime($date->key2));

                $found_year = false;
                $found_month = false;
                $found_day = false;
                //first key is the year
                foreach($date_data as $ykey => $data)
                {
                    if ($data['key'] == $year_ky)
                    {
                        $found_year = $ykey;
                        //second key is the month
                        foreach($data['items'] as $mkey=> $month)
                        {
                            if ($month['key'] == $month_ky)
                            {
                                $found_month = $mkey;
                                //third key is the day
                                foreach($month['items'] as $dkey=> $day)
                                {
                                    if ($day['key'] == $day_ky)
                                    {
                                        $found_day = $dkey;
                                        $day['count'] = $day['count'] + $date->count;
                                    }
                                }
                            }
                        }
                    }
                }
                
                if ($found_year === false) //must check the zero key
                {
                    $date_data[] = [
                        'key' => $year_ky,
                        'items' => [
                            [
                                'key' => $month_ky,
                                'items' => [
                                    [
                                        'key' => $day_ky,
                                        'count' => $date->count
                                    ]
                                ]
                            ]
                        ]
                    ];
                }else
                if ($found_month === false)
                {
                    $date_data[$ykey]['items'][] = [
                        'key' => $month_ky,
                        'items' => [
                            [
                                'key' => $day_ky,
                                'count' => $date->count
                            ]
                        ]
                    ];
                }else
                if ($found_day === false)
                {
                    $date_data[$ykey]['items'][$mkey]['items'][] = [
                        'key' => $day_ky,
                        'count' => $date->count
                    ];
                }

                
            }
            return ['data' => $date_data];
        }
        foreach($query as $d)
        {
            $json[] = ['key'=>$d->key2,'value'=>$d->count, 'items'=>null];
        }
        return ['data'=>$json,'totalCount'=>$query->count()];
    }
    
    return $query->skip(($request->skip)??0)->take(($request->take)??10)->get();
}


