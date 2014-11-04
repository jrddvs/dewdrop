<?php

namespace Dewdrop\Db\Select\Filter;

use Dewdrop\Db\Select;
use Dewdrop\Db\Select\Filter\Exception\InvalidOperator;
use Dewdrop\Db\Select\Filter\Exception\MissingQueryVar;

class Reference
{
    const OP_IS = 'is';

    const OP_IS_NOT = 'is-not';

    private $tableName;

    private $columnName;

    public function __construct($tableName, $columnName)
    {
        $this->tableName  = $tableName;
        $this->columnName = $columnName;
    }

    public function apply(Select $select, $conditionSetName, array $queryVars)
    {
        if (!isset($queryVars['comp'])) {
            throw new MissingQueryVar('"comp" variable expected.');
        }

        if (!isset($queryVars['value'])) {
            throw new MissingQueryVar('"value" variable expected.');
        }

        $operator = $queryVars['comp'];
        $value    = $queryVars['value'];

        if (!$this->isValidOperator($operator)) {
            throw new InvalidOperator("{$operator} is not a valid operator for reference filters.");
        }

        // Don't attempt to filter if no value is available
        if (!$value) {
            return $select;
        }

        return $this->filter($operator, $select, $conditionSetName, $value);
    }

    private function filter($operator, Select $select, $conditionSetName, $value)
    {
        $quotedAlias = $select->quoteWithAlias($this->tableName, $this->columnName);
        $operator    = (self::OP_IS === $operator ? '=' : '!=');

        return $select->whereConditionSet($conditionSetName, "{$quotedAlias} {$operator} ?", $value);
    }

    private function isValidOperator($operator)
    {
        static $validOperators = array(
            self::OP_IS,
            self::OP_IS_NOT
        );

        return in_array($operator, $validOperators);
    }
}
