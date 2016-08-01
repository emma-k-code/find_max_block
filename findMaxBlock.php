<?php
$time = microtime();
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
    
    $shape = array(); // 儲存相鄰的1的形狀
    $check = $origin; // 將原始陣列存入$check
    
    foreach ($check as $y=>$column) {
        foreach ($column as $x=>$n) {
            $haveOne = array(); // 儲存為1的座標
            $needFind = array();
            if ($n==1) {
                $haveOne[] = array($y,$x);
                find($y,$x); // 搜尋相鄰區域
            }
            
            if (sizeof($haveOne)>1) {
                $shape[] = $haveOne; 
            }
            
        }
        
    }
    
    // 搜尋最大面積
    $big = 0;
    foreach ($shape as $value) {
        $big = (sizeof($value) > $big)? sizeof($value):$big;
    }
    
    // 將最大的相鄰區塊的座標填上1
    foreach ($shape as $value) {
        if (sizeof($value)!=$big)
            continue;
        
        $output = $check;
        foreach ($value as $xy) {
            $shapeY = $xy[0];
            $shapeX = $xy[1];
            $output[$shapeY][$shapeX] = 1;
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
        global $needFind;
        global $haveOne;
        
        $check[$y][$x] = 0 ; // 將找過的改為0
        
        // 加入要搜尋的右下左上的座標
        $needFind[] = array($y,$x+1); // 右
        $needFind[] = array($y+1,$x); // 下
        $needFind[] = array($y,$x-1); // 左
        $needFind[] = array($y-1,$x); // 上
        
        // 搜尋$needFind中的座標
        foreach ($needFind as $key=>$value) {
            $findY = $value[0];
            $findX = $value[1];
            
            unset($needFind[$key]); // 將找過的座標刪除
            if ($check[$findY][$findX]==1) {
                $haveOne[] = array($findY,$findX);
                find($findY,$findX); // 搜尋該座標的相鄰區域
            }
            
        }
        
    }
    
    echo microtime() - $time;
    
?>