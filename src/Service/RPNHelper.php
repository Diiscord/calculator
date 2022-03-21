<?php

namespace App\Service;

class RPNHelper
{
    public function getPriority(string $operator): int
    {
        if ($operator === '(') {
            return 0;
        } else if ($operator === '+' || $operator === '-') {
            return 1;
        } else {
            return 2;
        }
    }

    public function convertToRPN(array $splitOperation): array
    {
        $result = [];
        $stack = [];

        foreach ($splitOperation as $entry) {
            if (is_numeric($entry)) {
                array_push($result, (int)$entry);
            } elseif ($entry === '(') {
                array_unshift($stack, $entry);
            } elseif ($entry === ')') {
                while ($stack[0] !== '(') {
                    array_push($result, array_shift($stack));
                }
                array_shift($stack);
            } else {
                while (!empty($stack) && $this->getPriority($stack[0]) >= $this->getPriority($entry)) {
                    array_push($result, array_shift($stack));
                }
                array_unshift($stack, $entry);
            }
        }
        while (!empty($stack)) {
            array_push($result, array_shift($stack));
        }

        return $result;
    }

    function computeRPN(array $RPN): float
    {
        $stack = [];
     
        foreach ($RPN as $entry)
        {
            $tokenNum = '';
     
            if (is_numeric($entry)) {
                array_push($stack, $entry);
            }
            else
            {
                $secondOperand = end($stack);
                array_pop($stack);
                $firstOperand = end($stack);
                array_pop($stack);

                switch ($entry) {
                    case '*':
                        array_push($stack, $firstOperand * $secondOperand);
                        break;
                    case '/':
                        array_push($stack, $firstOperand / $secondOperand);
                        break;
                    case '+':
                        array_push($stack, $firstOperand + $secondOperand);
                        break;
                    case '-':
                        array_push($stack, $firstOperand - $secondOperand);
                        break;
                    default:
                        throw new \Exception('Unrecognized character.');
                }
            }
        }

        return end($stack);
    }

    public function splitOperation(string $operation): array
    {
        $splitOperation = preg_split('/(?=[\+\-\*\/\(\)])|(?<=[\+\-\*\/\(\)])/', $operation);
        return array_filter($splitOperation, static fn($value) => $value !== '');
    }

    public function compute(string $operation)
    {
        try {
            $splitOperation = $this->splitOperation($operation);
            $RPN = $this->convertToRPN($splitOperation);
            return $this->computeRPN($RPN);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}