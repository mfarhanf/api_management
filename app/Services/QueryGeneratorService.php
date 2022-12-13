<?php

namespace App\Services;

class QueryGeneratorService
{
    public function generateQuery($params)
    {
        $query = 'select ' . ($params['is_distinct'] ? 'distinct ' : '');
        $query .= implode(',', $params['columns']);
        $query .= ' from ' . $params['table_name'];
        $query .= ' where 1=1 ';

        if (!empty($params['table_name'])) {
            $query .= 'and ' . $params['filter'] . ' ' . $params['operator'] . ' \'' . $params['operator_value'] .'\'';
        }

        return $query;
    }
}
