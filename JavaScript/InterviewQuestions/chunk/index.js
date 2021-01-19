const { array } = require("yargs");

function chunk() {
    var arr = [1,2,3,4,5];
    const size = 10;
    return myWay(arr, size);
}

function myWay(arr, size){
    var arr_final = [];
    var pos = 0;
    var cont_temp = 0;
    
    for(var i=0; i<arr.length; i++){
        if(i%size == 0){
        	pos = i/size;
        	arr_final[pos] = [];
          cont_temp = 0;
        }
            
        arr_final[pos][cont_temp] = arr[i];    
        cont_temp++;
    }   
    console.log(arr_final);
}

function solution(arr, size)
{
    const chunked = []; //Create an empty array to hold chunks

    for(let element of arr){ //For each element in the unchunked array
        const last = chunked[chunked.length - 1]; //Retrieve the last element in chunked

        if(!last || last.length === size) { //If last element does not exist, or if its lenght is equal to chunk size
            chunked.push([element]); //Push a new chunk into 'chunked' with the current element
        } else {
            last.push(element); //Add the current element into the chunk
        }
    }

    console.log(chunked);
}


function solution2(arr, size)
{
    const chunked = []; //Create an empty array to hold chunks
    let index = 0;

    while(index < arr.length){
        chunked.push(arr.slice(index, index+size));
        index += size;
    }

    console.log(chunked);
}
