function fizzbuzz(str) {
    return myWay(str);
}

function myWay(str){
    for(var i=1; i<=str; i++){
        if(i%3==0 && i%5==0)
            console.log('fizzbuzz');
        else if(i%3==0)
            console.log('fizz');
        else if(i%5==0)
            console.log('buzz');
        else    
            console.log(i);
    }
}

function solution(str)
{
    //same
}