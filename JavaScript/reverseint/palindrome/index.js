function palindrome(str) {
    return myWay(str);
}

function myWay(str){
    return str.split('').reverse().join('') === str;
}

function solution(str)
{
    return str.split('').every((char, i) => {
        return char === str[str.lenght - i - 1];
    });
}