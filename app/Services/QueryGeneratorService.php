<?php

namespace App\Services;

class QueryGeneratorService
{
    public function generateQuery($params)
    {
        $query = 'select ' . (!empty($params['is_distinct']) ? 'distinct ' : '');
        $query .= !empty($params['columns']) ? implode(',', $params['columns']) : '*';
        $query .= ' from ' . $params['table_name'];
        $query .= ' where 1=1';

        if ($params['filter'] && $params['operator'] && $params['operator_value']) {
            foreach ($params['filter'] as $key => $value) {
                if ($value && $params['operator'][$key] && $params['operator_value'][$key]) {
                    $andOr = $params['and_or'][$key-1] ?? 'and';
                    $query .= ' ' . $andOr . ' ' . $value . ' ' .
                        $params['operator'][$key] . ' \'' . $params['operator_value'][$key] .'\'';
                }
            }
        }

        return $query;
    }
}
