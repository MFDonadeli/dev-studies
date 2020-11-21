function anagrams(stringA, stringB) {
    console.log(myWay(stringA, stringB));
}

function myWay(stringA, stringB){
    var aaa = stringA.split('').sort();
    var bbb = stringB.split('').sort();
    
    for(var i=0; i<aaa.length; i++){
    	if(aaa[i] !== bbb[i])
      	    return false;
    }
    
    return true;
}


function solution(stringA, stringB)
{
    const aCharMap = buildCharMap(stringA);
    const bCharMap = buildCharMap(stringB);

    if(Object.keys(aCharMap).length !== Object.keys(bCharMap).length)
        return false;

    for(let char in aCharMap){
        if(aCharMap[char] !== bCharMap[char])
            return false;
    }

    return true;
}

function buildCharMap(str){
    const charMap = {};
    
    for(let char of str.replace(/[^\w]/g, '').toLowerCase()){
        charMap[char] = charMap[char] + 1 || 1; //if does not exists put one on position
    }
}

function solution2(stringA, stringB){
    return cleanString(stringA) === cleanString(stringB);
}

function cleanString(str){
    return str.replace(/[^\w]/g, '').toLowerCase().split('').sort().join();
}