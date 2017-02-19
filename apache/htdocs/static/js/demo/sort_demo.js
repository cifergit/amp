/**
 * Created by cifer on 2017/2/16.
 */
var arr = [5,1,7,0,9,2,3,8,4,6];

//冒泡排序
function bubbleSort(arr){
    if(arr.length > 1){
        var len = arr.length;
        var i,j,temp;
        for(i = 0;i < len;i++){
            for(j = 0;j < len - i;j++){
                if(arr[j] > arr[j+1]){
                    temp = arr[j];
                    arr[j] = arr[j+1];
                    arr[j+1] = temp;
                }
            }
        }
    }
    return arr;
}
arr = bubbleSort(arr);

//选择排序
function selectSort(arr){
    if(arr.length > 1){
        var len = arr.length;
        var i,j,temp;
        for(i = 0;i < len;i++){
            for(j = i+1;j < len;j++){
                if(arr[i] > arr[j]){
                    temp = arr[i];
                    arr[i] = arr[j];
                    arr[j] = temp;
                }
            }
        }
    }
    return arr;
}
arr = selectSort(arr);

//插入排序
function insertSort(arr){
    if(arr.length > 1){
        var len = arr.length;
        var i,j,temp;
        for(i = 1;i < len;i++){
            temp = arr[i];
            j = i;
            while(j > 0 && arr[j-1] > temp){
                arr[j] = arr[j-1];
                j--;
            }
            arr[j] = temp;
        }
    }
    return arr;
}
arr = insertSort(arr);

//归并排序
function mergeSort(arr){
    if (arr.length < 2){
        return arr;
    }
    var step = 1;
    var left, right;
    while(step < arr.length){
        left = 0;
        right = step;
        while(right + step <= arr.length){
            mergeArrays(arr, left, left+step, right, right+step);
            left = right + step;
            right = left + step;
        }
        if (right < arr.length){
            mergeArrays(arr, left, left+step, right, arr.length);
        }
        step *= 2;
    }
    return arr;
}
function mergeArrays(arr, startLeft, stopLeft, startRight, stopRight){
    var leftArr = new Array(stopLeft - startLeft + 1);
    var rightArr = new Array(stopRight - startRight + 1);
    var k = startLeft;
    for(var i = 0;i < (leftArr.length-1);i++){
        leftArr[i] = arr[k];
        k++;
    }
    k = startRight;
    for(var i = 0;i < (rightArr.length-1);i++){
        rightArr[i] = arr[k];
        k++;
    }
    rightArr[rightArr.length-1] = Infinity;
    leftArr[leftArr.length-1] = Infinity;
    var m = 0,n = 0;
    for(k = startLeft;k < stopRight;k++){
        if (leftArr[m] <= rightArr[n]){
            arr[k] = leftArr[m];
            m++;
        }
        else {
            arr[k] = rightArr[n];
            n++;
        }
    }
}
arr = mergeSort(arr);

//希尔排序
function shellSort(arr){
    if(arr.length > 1){
        var len = arr.length;
        var g,i,j, k,temp;
        //第几轮分组
        for(g = Math.floor(len / 2);g > 0;g = Math.floor(g / 2)){
            for(i = 0;i < g;i++){
                for(j = i + g;j < len;j = j + g){
                    if(arr[j - g] > arr[j]){
                        temp = arr[j];
                        k = j - g;
                        while(k >= 0 && arr[k] > temp){
                            arr[k + g] = arr[k];
                            k = k - g;
                        }
                        arr[k + g] = temp;
                    }
                }
            }
        }

    }
    return arr;
}
arr = shellSort(arr);

//快速排序
function quickSort(arr) {
    var len = arr.length;
    if(len == 0){
        return [];
    }
    else if(len == 1){
        return arr;
    }
    var smallArr = [];
    var largeArr = [];
    var pivot = arr[0];
    for (var i = 1; i < len; i++) {
        if (arr[i] < pivot) {
            smallArr.push(arr[i]);
        } else {
            largeArr.push(arr[i]);
        }
    }
    return quickSort(smallArr).concat(pivot, quickSort(largeArr));
}
arr = quickSort(arr);









//以为是计算时间例子
//分别是每次的计算的开始时间与结束时间
var d1,d2;
//保存每次计算的时候
var arrTime = [];
//随机生成数组元素
function getArr(){
    var arr = [];
    for(var i = 0;i < 10000;i++){
        arr.push(Math.floor(Math.random()*10000));
    }
    return arr;
}
//快速排序

//获取时间
function getTime(){
    //计算100次，取平均值，减小误差
    for(var k = 0;k < 100;k++){
        var arr = getArr();
        d1 = new Date().getTime();
        arr = quickSort(arr);
        d2 = new Date().getTime();
        arrTime.push(d2-d1);
    }
    var all = 0;
    for(var m = 0;m < arrTime.length;m++){
        all = all + arrTime[m];
    }
    console.log(arrTime);
    console.log(all/arrTime.length);
}
getTime();