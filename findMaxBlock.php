<?php
// 1.使用foreach將$check陣列全部搜尋一遍 並把已搜尋過的都改為0
// 2.當搜尋到1時 將其座標存入$haveOne 相鄰的座標存入$needFind中
// 3.再使用foreach 搜尋$needFind中座標的相鄰座標 並將以搜尋的座標從$needFind中刪除
// 4.重複2跟3直到$needFind中已沒有座標
// 5.將$haveOne中所存的座標數量與$big比對 當$haveOne>$big時 $big = $haveOne
// 6.依$big中的座標 將$check中相應的座標改為1
// 7.用foreach輸出$check的內容
$origin = array(
        array(1, 1, 0, 0, 0, 0, 0, 0, 0, 0),
        array(1, 1, 0, 1, 1, 0, 0, 0, 0, 0),
        array(0, 0, 0, 1, 1, 0, 0, 0, 0, 0),
        array(0, 0, 0, 0, 0, 1, 1, 1, 0, 0),
        array(1, 1, 1, 1, 1, 0, 0, 0, 0, 0),
        array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
        array(1, 1, 1, 0, 1, 0, 1, 1, 1, 1),
        array(1, 0, 0, 0, 1, 0, 1, 1, 1, 1),
        array(1, 0, 0, 0, 1, 0, 1, 1, 1, 1),
        array(1, 1, 0, 1, 1, 0, 0, 0, 0, 1)
    );
    
    $big = array(); // 相鄰最多1的座標
    $check = $origin; // 將原始陣列存入$check
    
    foreach ($check as $y=>$column) {
        foreach ($column as $x=>$n) {
            $haveOne = array(); // 儲存相鄰的1的座標
            $needFind = array();
            if ($n==1) {
                $check[$y][$x] = "0"; // 將找過的都改為0
                $haveOne[] = array($y,$x);
                find($y,$x); // 搜尋相鄰區域
            }
           
            // 判斷此區域所含有的1 是否多於目前最大的區域數量
            if (sizeof($haveOne)>sizeof($big[0])) {
                unset($big);
                $big[] = $haveOne;
            }elseif (sizeof($haveOne) == sizeof($big[0])) {
                $big[] = $haveOne;
            }
        }
        
    }
    
    // 將最大的相鄰區塊的座標填上1
    foreach ($big as $value) {
        $output = $check;
        foreach ($value as $xy) {
            $bigY = $xy[0];
            $bigX = $xy[1];
            $output[$bigY][$bigX] = 1;
        }
        
        // 輸出結果
        foreach ($output as $column) {
            foreach ($column as $n) {
                echo $n;
            }
            echo "<br>";
        }
        
        echo "<hr>";
    }
    
    function find($y,$x) {
        global $check;
        global $haveOne;
        global $needFind;
        global $i;
        // 加入要搜尋的右下左上的座標
        if ($check[$y][$x+1] == 1) {
            $needFind[] = array($y,$x+1); // 右
        }
        if ($check[$y+1][$x] == 1) {
            $needFind[] = array($y+1,$x); // 下
        }
        if ($check[$y][$x-1] == 1) {
            $needFind[] = array($y,$x-1); // 左
        }
        if ($check[$y-1][$x] == 1) {
            $needFind[] = array($y-1,$x); // 上
        }
        
        // 搜尋$needFind中的座標
        foreach ($needFind as $key=>$value) {
            $findY = $value[0];
            $findX = $value[1];
            
            if ($check[$findY][$findX]==1) {
                $haveOne[] = array($findY,$findX);
            }
            $check[$findY][$findX] = "0";
            unset($needFind[$key]); // 將找過的座標刪除
            find($findY,$findX); // 搜尋該座標的相鄰區域
        }
        
    }
    
?>