function reverse(str) {
    return myWay(str);
}

function myWay(str){
    var ret = 0;

    if(Number.isNaN(str))
        return 0;
        
    const sign = Math.sign(str);
    var aaa = Math.abs(str).toString();
    
    for(var i=aaa.length-1; i>=0; i--)
    {
        ret += aaa[i];
    }

    return parseInt(ret) * sign;
}


function solution(str){
    const reversed = str
        .toString()
        .split('')
        .reverse()
        .join('');

    return parseInt(reversed) * Math.sign(str);
}