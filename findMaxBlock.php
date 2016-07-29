<?php
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
                // 將原儲存的資料刪除
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