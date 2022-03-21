import { OPERATORS } from "../constants";

export const cleanOperation = (rawOperation) => {
    // Split by operators but keep the operators
    let splitOperation = rawOperation.split(/(?=[\+\-\*\/\(\)])|(?<=[\+\-\*\/\(\)])/);

    // Remove useless 0
    splitOperation = splitOperation.map((entry) => (
        isNaN(entry) ? entry : parseInt(entry, 10)
    ));

    return splitOperation.join('');
}

export const isOperator = (char) => OPERATORS.includes(char);

export const canAddMinus = (char) => '*/'.includes(char);