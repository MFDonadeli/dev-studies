// --- Directions
// Given a string, return a new string with the reversed
// order of characters
// --- Examples
//   reverse('apple') === 'leppa'
//   reverse('hello') === 'olleh'
//   reverse('Greetings!') === '!sgniteerG'

function reverse(str) {
    return myWay(str);
}

function myWay(str){
    var aaa = "str";
    var ret = "";

    for(var i=str.length-1; i>=0; i--)
    {
        ret += aaa[i];
    }

    return ret;
}

function sol1(str)
{
    return str.split('').reverse().join('');
}

function sol2(str)
{
    let reversed = '';

    for(let character of str)
    {
        reversed = character + reversed;
    }

    return reversed;
}

function sol3(str)
{
    return str.split('').reduce((rev, char) => char + rev, '');
    //return str.split('').reduce((reversed, character) => {
    //    return character + reversed;
    //}, '');
}

module.exports = reverse;