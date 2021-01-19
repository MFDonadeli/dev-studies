function maxhcar(str) {
    return myWay(str);
}

function myWay(str){
    var aaa = str.split('').sort();
    var char = '';
    var tmp = '';
    var count = 0;
    var max = 0;

    for(let character of aaa)
    {
        if(tmp != character){
            
            if(count > max){
                max = count;
                char = tmp;
            }
            
            tmp = character;
            count = 0;
        }
        
        count++;
    }
    
    if(count > max){
      max = count;
      char = tmp;
    }

    return char;
}


function solution(str)
{
    const charMap = {};
    let max=0;
    let maxChar = '';

    for(let char of str){
        if(charMap[char]){
            charMap[char]++;
        } else {
            charMap[char]=1;
        }
    }

    for(let char in charMap){
        if(charMap[char] > max){
            max = charMap[char];
            maxChar = char;
        }
    }

    return maxChar;
}